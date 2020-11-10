<?php

namespace App\Entity;

use App\Repository\PanneauOffreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanneauOffreRepository::class)
 */
class PanneauOffre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Offre::class, inversedBy="panneauOffres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offre;

    /**
     * @ORM\ManyToOne(targetEntity=Panneau::class, inversedBy="panneauOffres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $panneau;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOffre(): ?Offre
    {
        return $this->offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }

    public function getPanneau(): ?Panneau
    {
        return $this->panneau;
    }

    public function setPanneau(?Panneau $panneau): self
    {
        $this->panneau = $panneau;

        return $this;
    }
}
