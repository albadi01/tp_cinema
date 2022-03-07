<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtisteRepository::class)
 */
class Artiste
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Film::class, mappedBy="realisateur")
     */
    private $films_realises;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    public function __construct()
    {
        $this->films_realises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilmsRealises(): Collection
    {
        return $this->films_realises;
    }

    public function addFilmsRealise(Film $filmsRealise): self
    {
        if (!$this->films_realises->contains($filmsRealise)) {
            $this->films_realises[] = $filmsRealise;
            $filmsRealise->setRealisateur($this);
        }

        return $this;
    }

    public function removeFilmsRealise(Film $filmsRealise): self
    {
        if ($this->films_realises->removeElement($filmsRealise)) {
            // set the owning side to null (unless already changed)
            if ($filmsRealise->getRealisateur() === $this) {
                $filmsRealise->setRealisateur(null);
            }
        }

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
