<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TacheRepository")
 */
class Tache
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
    private $nomtache;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datedebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datefin;

    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="taches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employ;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="tache")
     */
    private $commentaires;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Stock", inversedBy="taches")
     */
    private $stocks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MessageTache", mappedBy="tache")
     */
    private $messagetaches;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service", inversedBy="taches")
     */
    private $service;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->messagetaches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomtache(): ?string
    {
        return $this->nomtache;
    }

    public function setNomtache(string $nomtache): self
    {
        $this->nomtache = $nomtache;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

      public function getEmploy(): ?user
    {

        return $this->employ;
    }

    public function setEmploy(?user $employ): self
    {
        $this->employ = $employ;
        return $this;
    }

    /**
     * @return Collection|commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setTache($this);
        }

        return $this;
    }

    public function removeCommentaire(commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getTache() === $this) {
                $commentaire->setTache(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
        }

        return $this;
    }

    public function removeStock(stock $stock): self
    {
        if ($this->stocks->contains($stock)) {
            $this->stocks->removeElement($stock);
        }

        return $this;
    }

    /**
     * @return Collection|MessageTache[]
     */
    public function getMessagetaches(): Collection
    {
        return $this->messagetaches;
    }

    public function addMessagetach(MessageTache $messagetach): self
    {
        if (!$this->messagetaches->contains($messagetach)) {
            $this->messagetaches[] = $messagetach;
            $messagetach->setTache($this);
        }

        return $this;
    }

    public function removeMessagetach(MessageTache $messagetach): self
    {
        if ($this->messagetaches->contains($messagetach)) {
            $this->messagetaches->removeElement($messagetach);
            // set the owning side to null (unless already changed)
            if ($messagetach->getTache() === $this) {
                $messagetach->setTache(null);
            }
        }

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }
    public function __toString()
    {
        return $this->nomtache;
    }
}
