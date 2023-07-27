<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateA = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $statueA = null;
  
    #[ORM\ManyToOne(inversedBy: 'annonces', fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;
    #[Ignore]
    #[ORM\OneToMany(mappedBy: 'annonce', targetEntity: Demande::class, orphanRemoval: true)]
    private Collection $demandes;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

  

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateA(): ?\DateTimeInterface
    {
        return $this->dateA;
    }

    public function setDateA(\DateTimeInterface $dateA): static
    {
        $this->dateA = $dateA;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getStatueA(): ?string
    {
        return $this->statueA;
    }

    public function setStatueA(string $statueA): static
    {
        $this->statueA = $statueA;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): static
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes->add($demande);
            $demande->setAnnonce($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): static
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getAnnonce() === $this) {
                $demande->setAnnonce(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }



	/**
	 * @return 
	 */
	public function getImage(): ?string {
		return $this->image;
	}
	
	/**
	 * @param  $image 
	 * @return self
	 */
	public function setImage(?string $image): self {
		$this->image = $image;
		return $this;
	}
}