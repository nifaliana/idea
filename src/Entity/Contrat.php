<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 * @Vich\Uploadable
 */
class Contrat
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
    private $bordereau;

    /**
     * @Vich\UploadableField(mapping="contrat", fileNameProperty="bordereau")
     * @var File
     */
    private $imageFile;


    /**
     * @ORM\Column(type="datetime")
     */
    private $signedAt;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\GreaterThanOrEqual(propertyPath="signedAt")
     */
    private $endedAt;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\OneToMany(targetEntity=Panneau::class, mappedBy="contrat")
     */
    private $panneaus;

    /**
     * @ORM\OneToMany(targetEntity=Payement::class, mappedBy="contrat", cascade={"persist"}, orphanRemoval=true)
     */
    private $payement;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="contrats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;



    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    public function __construct()
    {
        $this->panneaus = new ArrayCollection();
        $this->payement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBordereau(): ?string
    {
        return $this->bordereau;
    }

    public function setBordereau(string $bordereau): self
    {
        $this->bordereau = $bordereau;

        return $this;
    }

    public function getSignedAt(): ?\DateTimeInterface
    {
        return $this->signedAt;
    }

    public function setSignedAt(\DateTimeInterface $signedAt): self
    {
        $this->signedAt = $signedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    public function setEndedAt(\DateTimeInterface $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

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
            $panneau->setContrat($this);
        }

        return $this;
    }

    public function removePanneau(Panneau $panneau): self
    {
        if ($this->panneaus->contains($panneau)) {
            $this->panneaus->removeElement($panneau);
            // set the owning side to null (unless already changed)
            if ($panneau->getContrat() === $this) {
                $panneau->setContrat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Payement[]
     */
    public function getPayement(): Collection
    {
        return $this->payement;
    }

    public function addPayement(Payement $payement): self
    {
        if (!$this->payement->contains($payement)) {
            $this->payement[] = $payement;
            $payement->setContrat($this);
        }

        return $this;
    }

    public function removePayement(Payement $payement): self
    {
        if ($this->payement->contains($payement)) {
            $this->payement->removeElement($payement);
            // set the owning side to null (unless already changed)
            if ($payement->getContrat() === $this) {
                $payement->setContrat(null);
            }
        }

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     */
    public function setImageFile(File $imageFile = null )
    {
        $this->imageFile = $imageFile;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imageFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Contrat
     */
    public function setUpdatedAt(\DateTime $updatedAt): Contrat
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }



    public function __toString()
    {
        return $this->getBordereau();
    }
}
