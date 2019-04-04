<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaisseLogRepository")
 */
class CaisseLog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Typetransaction;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $Somme;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet")
     */
    private $Projet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stock")
     */
    private $Stock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypetransaction(): ?string
    {
        return $this->Typetransaction;
    }

    public function setTypetransaction(string $Typetransaction): self
    {
        $this->Typetransaction = $Typetransaction;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSomme(): ?float
    {
        return $this->Somme;
    }

    public function setSomme(float $Somme): self
    {
        $this->Somme = $Somme;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->Projet;
    }

    public function setProjet(?Projet $Projet): self
    {
        $this->Projet = $Projet;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->Stock;
    }

    public function setStock(?Stock $Stock): self
    {
        $this->Stock = $Stock;

        return $this;
    }
}
