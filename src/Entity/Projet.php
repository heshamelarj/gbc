<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 */
class Projet
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
    private $nomprojet;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datefin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datedebut;

    /**
     * @ORM\Column(type="float")
     */
    private $budget;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $avance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="projets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Service", mappedBy="projet", cascade={"persist"}, orphanRemoval=true)
     */
    private $services;

    /**
     * @return mixed
     */
    public function getServices(): ?Collection
    {
        return $this->services;
    }


    /**
     * @param Service $service
     * @return Projet
     */
    public function addService(Service $service) :self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;

            $service->setProjet($this);
        }

        return $this;

    }


    public function __construct()
    {
        $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomprojet(): ?string
    {
        return $this->nomprojet;
    }

    public function setNomprojet(string $nomprojet): self
    {
        $this->nomprojet = $nomprojet;

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

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getBudget(): ?float
    {
        return $this->budget;
    }

    public function setBudget(float $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getAvance(): ?float
    {
        return $this->avance;
    }

    public function setAvance(?float $avance): self
    {
        $this->avance = $avance;

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
}
