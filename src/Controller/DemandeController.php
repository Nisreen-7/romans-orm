<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Repository\AnnonceRepository;
use App\Repository\DemandeRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/demande')]

class DemandeController extends AbstractController
{
    public function __construct(private DemandeRepository $repo, private EntityManagerInterface $em) {}

    #[Route(methods:'GET')]
    public function all(Request $request): JsonResponse
    {

        return $this->json($this->repo->findAll());
    }

    #[Route('/{id}', methods: 'GET')]
    public function one(Demande $demande) {
        return $this->json($demande);
    }

    #[Route(methods: 'POST')]
    public function add(Request $request, SerializerInterface $serializer,UtilisateurRepository $utilisateurRepo ,AnnonceRepository $annonceRepo): JsonResponse {
        try {
            $demande = $serializer->deserialize($request->getContent(), Demande::class, 'json');
        } catch (\Exception $e) {
            return $this->json('Invalid Body', 400);
        }

        // $utilisateurId = $demande->getUtilisature()->getId();
        // $annonceId = $demande->getAnnonce()->getId();
        $utilisateur = $utilisateurRepo->find(1);
        $annonce = $annonceRepo->find(19);
        $demande->setUtilisature($utilisateur);
        $demande->setAnnonce($annonce);
        //  $demande->setUtilisature($utilisateurRepo->find(1));
        //  $demande->setAnnonce($annonceRepo->find(1));
        //  $annonce = $demande->getAnnonce();
        //  $this->em->persist($annonce);
        $this->em->persist($demande);
        $this->em->flush();
        return $this->json($demande, 201);

    }


    // #[Route(methods: 'POST')]
    // public function addDemAnn(Request $request, SerializerInterface $serializer, UtilisateurRepository $utilisateurRepo): JsonResponse {
    //     try {
    //         $demande = $serializer->deserialize($request->getContent(), Demande::class, 'json');
    //     } catch (\Exception $e) {
    //         return $this->json('Invalid Body', 400);
    //     }

    //     $annonce = $demande->getAnnonce();
    //     $demande->setUtilisature($utilisateurRepo->find(1));
    //     $this->em->persist($annonce);
    //     $this->em->persist($demande);
    //     $this->em->flush();
    //     return $this->json($demande, 201);

    // }

    #[Route('/{id}', methods: 'DELETE')]
    public function delete(Demande $demande): JsonResponse {
        $this->em->remove($demande);
        $this->em->flush();
        return $this->json(null, 204);
    }
    
    #[Route('/{id}', methods: 'PATCH')]
    public function update(Demande $demande, Request $request, SerializerInterface $serializer): JsonResponse {
        try {
            $serializer->deserialize($request->getContent(), Annonce::class, 'json', [
                'object_to_populate' => $demande
            ]);
        } catch (\Exception $th) {
            return $this->json('Invalid body', 400);
        }

        $this->em->flush();

        return $this->json($demande);
    }
}
