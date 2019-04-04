<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactureRepository")
 */
class Facture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $desingation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="factures")
     */
    private $fournisseur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="factures")
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneFacture", mappedBy="facture")
     */
    private $lignefactures;

    public function __construct()
    {
        $this->lignefactures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDesingation(): ?string
    {
        return $this->desingation;
    }

    public function setDesingation(string $desingation): self
    {
        $this->desingation = $desingation;

        return $this;
    }

    public function getFournisseur(): ?fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|LigneFacture[]
     */
    public function getLignefactures(): Collection
    {
        return $this->lignefactures;
    }

    public function addLignefacture(LigneFacture $lignefacture): self
    {
        if (!$this->lignefactures->contains($lignefacture)) {
            $this->lignefactures[] = $lignefacture;
            $lignefacture->setFacture($this);
        }

        return $this;
    }

    public function removeLignefacture(LigneFacture $lignefacture): self
    {
        if ($this->lignefactures->contains($lignefacture)) {
            $this->lignefactures->removeElement($lignefacture);
            // set the owning side to null (unless already changed)
            if ($lignefacture->getFacture() === $this) {
                $lignefacture->setFacture(null);
            }
        }

        return $this;
    }
}
