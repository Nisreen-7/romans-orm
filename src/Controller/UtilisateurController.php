<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
#[Route('/api/utilisateur')]
class UtilisateurController extends AbstractController
{
    public function __construct(private UtilisateurRepository $repo, private EntityManagerInterface $em) {}

    #[Route(methods:'GET')]
    public function all(Request $request): JsonResponse
    {

        return $this->json($this->repo->findAll());
    }

    #[Route('/{id}', methods: 'GET')]
    public function one(Utilisateur $user) {
        return $this->json($user);
    }

    #[Route(methods: 'POST')]
    public function add(Request $request, SerializerInterface $serializer): JsonResponse {
        try {
            $user = $serializer->deserialize($request->getContent(), Utilisateur::class, 'json');
        } catch (\Exception $e) {
            return $this->json('Invalid Body', 400);
        }

        $this->em->persist($user);
        $this->em->flush();
        return $this->json($user, 201);

    }

    #[Route('/{id}', methods: 'DELETE')]
    public function delete(Utilisateur $user): JsonResponse {
        $this->em->remove($user);
        $this->em->flush();
        return $this->json(null, 204);
    }
    
    #[Route('/{id}', methods: 'PATCH')]
    public function update(Utilisateur $user, Request $request, SerializerInterface $serializer): JsonResponse {
        try {
            $serializer->deserialize($request->getContent(), Utilisateur::class, 'json', [
                'object_to_populate' => $user
            ]);
        } catch (\Exception $th) {
            return $this->json('Invalid body', 400);
        }

        $this->em->flush();

        return $this->json($user);
    }
}
