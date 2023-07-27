<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_retour = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $raison = null;

    #[ORM\Column(length: 255)]
    private ?string $statueD = null;
    
    #[ORM\ManyToOne(inversedBy: 'demandes', fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisature = null;
    
    #[ORM\ManyToOne(inversedBy: 'demandes', fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Annonce $annonce = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->date_retour;
    }

    public function setDateRetour(\DateTimeInterface $date_retour): static
    {
        $this->date_retour = $date_retour;

        return $this;
    }

    public function getRaison(): ?string
    {
        return $this->raison;
    }

    public function setRaison(string $raison): static
    {
        $this->raison = $raison;

        return $this;
    }

    public function getStatueD(): ?string
    {
        return $this->statueD;
    }

    public function setStatueD(string $statueD): static
    {
        $this->statueD = $statueD;

        return $this;
    }

    public function getUtilisature(): ?Utilisateur
    {
        return $this->utilisature;
    }

    public function setUtilisature(?Utilisateur $utilisature): static
    {
        $this->utilisature = $utilisature;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): static
    {
        $this->annonce = $annonce;

        return $this;
    }
}