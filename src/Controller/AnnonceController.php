<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\Uploader;

#[Route('/api/annonce')]

class AnnonceController extends AbstractController
{
    public function __construct(private AnnonceRepository $repo, private EntityManagerInterface $em) {}

    #[Route(methods:'GET')]
    public function all(Request $request): JsonResponse
    {

        return $this->json($this->repo->findAll());
    }

    #[Route('/{id}', methods: 'GET')]
    public function one(Annonce $annonce) {
        return $this->json($annonce);
    }

    #[Route(methods: 'POST')]
    public function add(Uploader $uploader,Request $request, SerializerInterface $serializer, UtilisateurRepository $utilisateurRepo): JsonResponse {
        try {
            $annonce = $serializer->deserialize($request->getContent(), Annonce::class, 'json');
        } catch (\Exception $e) {
            return $this->json('Invalid Body', 400);
        }
        if($annonce->getImage()) {

            $filename = $uploader->upload($annonce->getImage());
            $annonce->setImage($filename);
        }
        $annonce->setUtilisateur($utilisateurRepo->find(1));
        $this->em->persist($annonce);
        $this->em->flush();
        return $this->json($annonce, 201);

    }

    #[Route('/{id}', methods: 'DELETE')]
    public function delete(Annonce $annonce): JsonResponse {
        $this->em->remove($annonce);
        $this->em->flush();
        return $this->json(null, 204);
    }
    
    #[Route('/{id}', methods: 'PATCH')]
    public function update(Annonce $annonce, Request $request, SerializerInterface $serializer): JsonResponse {
        try {
            $serializer->deserialize($request->getContent(), Annonce::class, 'json', [
                'object_to_populate' => $annonce
            ]);
        } catch (\Exception $th) {
            return $this->json('Invalid body', 400);
        }

        $this->em->flush();

        return $this->json($annonce);
    }


    #[Route('/search/{term}', methods: 'GET')]
    public function search(string $term): JsonResponse
    {
        return $this->json($this->repo->search($term));
    }
}
