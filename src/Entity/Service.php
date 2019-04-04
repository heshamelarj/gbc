<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
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
    private $nomservice;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datedebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datefin;

    

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="services")
     */
    private $employes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tache", mappedBy="service")
     */
    private $taches;

    public function __construct()
    {
        $this->teches = new ArrayCollection();
        $this->employes = new ArrayCollection();
        $this->taches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomservice(): ?string
    {
        return $this->nomservice;
    }

    public function setNomservice(string $nomservice): self
    {
        $this->nomservice = $nomservice;

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

   

   

    /**
     * @return Collection|user[]
     */
    public function getEmployes(): Collection
    {
        return $this->employes;
    }

    public function addEmploye(user $employe): self
    {
        if (!$this->employes->contains($employe)) {
            $this->employes[] = $employe;
        }

        return $this;
    }

    public function removeEmploye(user $employe): self
    {
        if ($this->employes->contains($employe)) {
            $this->employes->removeElement($employe);
        }

        return $this;
    }

    /**
     * @return Collection|tache[]
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(tache $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches[] = $tach;
            $tach->setService($this);
        }

        return $this;
    }

    public function removeTach(tache $tach): self
    {
        if ($this->taches->contains($tach)) {
            $this->taches->removeElement($tach);
            // set the owning side to null (unless already changed)
            if ($tach->getService() === $this) {
                $tach->setService(null);
            }
        }

        return $this;
    }
    public function __Tostring()
    {
        return $this->getNomservice();
    }
}
