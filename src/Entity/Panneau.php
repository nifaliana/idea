<?php

namespace App\Entity;

use App\Repository\PanneauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanneauRepository::class)
 */
class Panneau
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
    private $format;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $unit;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lat;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lng;

    /**
     * @ORM\Column(type="float")
     */
    private $tarifImpression;

    /**
     * @ORM\Column(type="float")
     */
    private $rating;

    /**
     * @ORM\OneToMany(targetEntity=PanneauOffre::class, mappedBy="panneau", orphanRemoval=true)
     */
    private $panneauOffres;

    /**
     * @ORM\ManyToOne(targetEntity=Confection::class, inversedBy="panneaus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $confection;

    /**
     * @ORM\ManyToOne(targetEntity=Typologie::class, inversedBy="panneaus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typologie;

    /**
     * @ORM\ManyToOne(targetEntity=Contrat::class, inversedBy="panneaus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contrat;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="panneau")
     */
    private $images;

    public function __construct()
    {
        $this->panneauOffres = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(string $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getTarifImpression(): ?float
    {
        return $this->tarifImpression;
    }

    public function setTarifImpression(float $tarifImpression): self
    {
        $this->tarifImpression = $tarifImpression;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return Collection|PanneauOffre[]
     */
    public function getPanneauOffres(): Collection
    {
        return $this->panneauOffres;
    }

    public function addPanneauOffre(PanneauOffre $panneauOffre): self
    {
        if (!$this->panneauOffres->contains($panneauOffre)) {
            $this->panneauOffres[] = $panneauOffre;
            $panneauOffre->setPanneau($this);
        }

        return $this;
    }

    public function removePanneauOffre(PanneauOffre $panneauOffre): self
    {
        if ($this->panneauOffres->contains($panneauOffre)) {
            $this->panneauOffres->removeElement($panneauOffre);
            // set the owning side to null (unless already changed)
            if ($panneauOffre->getPanneau() === $this) {
                $panneauOffre->setPanneau(null);
            }
        }

        return $this;
    }

    public function getConfection(): ?Confection
    {
        return $this->confection;
    }

    public function setConfection(?Confection $confection): self
    {
        $this->confection = $confection;

        return $this;
    }

    public function getTypologie(): ?Typologie
    {
        return $this->typologie;
    }

    public function setTypologie(?Typologie $typologie): self
    {
        $this->typologie = $typologie;

        return $this;
    }

    public function getContrat(): ?Contrat
    {
        return $this->contrat;
    }

    public function setContrat(?Contrat $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setPanneau($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getPanneau() === $this) {
                $image->setPanneau(null);
            }
        }

        return $this;
    }
}
