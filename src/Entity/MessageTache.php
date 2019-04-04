<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessagetacheRepository")
 */
class MessageTache
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="messagetaches")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tache", inversedBy="messagetaches")
     */
    private $tache;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

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

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTache(): ?tache
    {
        return $this->tache;
    }

    public function setTache(?tache $tache): self
    {
        $this->tache = $tache;

        return $this;
    }

    public function getUserr(): ?user
    {
        return $this->userr;
    }

    public function setUserr(?user $userr): self
    {
        $this->userr = $userr;

        return $this;
    }
}
