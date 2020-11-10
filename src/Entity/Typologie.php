<?php

namespace App\Entity;

use App\Repository\TypologieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypologieRepository::class)
 */
class Typologie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Panneau::class, mappedBy="typologie")
     */
    private $panneaus;

    public function __construct()
    {
        $this->panneaus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Panneau[]
     */
    public function getPanneaus(): Collection
    {
        return $this->panneaus;
    }

    public function addPanneau(Panneau $panneau): self
    {
        if (!$this->panneaus->contains($panneau)) {
            $this->panneaus[] = $panneau;
            $panneau->setTypologie($this);
        }

        return $this;
    }

    public function removePanneau(Panneau $panneau): self
    {
        if ($this->panneaus->contains($panneau)) {
            $this->panneaus->removeElement($panneau);
            // set the owning side to null (unless already changed)
            if ($panneau->getTypologie() === $this) {
                $panneau->setTypologie(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
