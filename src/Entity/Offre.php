<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\OneToMany(targetEntity=PanneauOffre::class, mappedBy="offre", orphanRemoval=true)
     */
    private $panneauOffres;

    public function __construct()
    {
        $this->panneauOffres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

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
            $panneauOffre->setOffre($this);
        }

        return $this;
    }

    public function removePanneauOffre(PanneauOffre $panneauOffre): self
    {
        if ($this->panneauOffres->contains($panneauOffre)) {
            $this->panneauOffres->removeElement($panneauOffre);
            // set the owning side to null (unless already changed)
            if ($panneauOffre->getOffre() === $this) {
                $panneauOffre->setOffre(null);
            }
        }

        return $this;
    }
}
