<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LignefactureRepository")
 */
class LigneFacture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $qte;

    /**
     * @ORM\Column(type="float")
     */
    private $prixunitaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Facture", inversedBy="lignefactures")
     */
    private $facture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQte(): ?float
    {
        return $this->qte;
    }

    public function setQte(float $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getPrixunitaire(): ?float
    {
        return $this->prixunitaire;
    }

    public function setPrixunitaire(float $prixunitaire): self
    {
        $this->prixunitaire = $prixunitaire;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }
}
