<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
 class User implements UserInterface
{
     /**
      * @var $passwordEncoder UserSecurity
      */

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade="ALL" , mappedBy="user")
     */
    private $image;

     /**
      * @var $file UploadedFile entity property
      */
    private $file;
    /**
     * @ORM\Column(type="datetime")
     */
    private $datenaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Metier", inversedBy="users")
     */
    private $metiers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Service", mappedBy="employes")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tache", mappedBy="employ")
     */
    private $taches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MessageTache", mappedBy="user")
     */
    private $messagetaches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="user")
     */
    private $messages;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function __construct()
    {
        $this->metiers = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->taches = new ArrayCollection();
        $this->messagetaches = new ArrayCollection();
        $this->messages = new ArrayCollection();
//        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return Collection|metier[]
     */
    public function getMetiers(): Collection
    {
        return $this->metiers;
    }

    public function addMetier(metier $metier): self
    {
        if (!$this->metiers->contains($metier)) {
            $this->metiers[] = $metier;
        }

        return $this;
    }

    public function removeMetier(metier $metier): self
    {
        if ($this->metiers->contains($metier)) {
            $this->metiers->removeElement($metier);
        }

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->addEmploye($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            $service->removeEmploye($this);
        }

        return $this;
    }

    /**
     * @return Collection|Tache[]
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches[] = $tach;
            $tach->setEmploy($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->taches->contains($tach)) {
            $this->taches->removeElement($tach);
            // set the owning side to null (unless already changed)
            if ($tach->getEmploy() === $this) {
                $tach->setEmploy(null);
            }
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
            $messagetach->setUser($this);
        }

        return $this;
    }

    public function removeMessagetach(MessageTache $messagetach): self
    {
        if ($this->messagetaches->contains($messagetach)) {
            $this->messagetaches->removeElement($messagetach);
            // set the owning side to null (unless already changed)
            if ($messagetach->getUser() === $this) {
                $messagetach->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setUser($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getUser() === $this) {
                $message->setUser(null);
            }
        }

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {

        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function getUsername()
    {
        return $this->getLogin();
    }

    public function getRoles()
    {
        return array('ROLE_USER'); //TODO: implement this method to get the roles of each user when authenticate
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


     /**
      * @return UploadedFile
      */
     public function getFile()
     {
         return $this->file;
     }

     /**
      * @param UploadedFile $file
      */
     public function setFile(UploadedFile $file ): void
     {
         $this->file = $file;
     }

     public function __toString()
     {
         // TODO: Implement __toString() method.
         return $this->getNom();
     }


     /**
      * @return mixed
      */
     public function getImage()
     {
         return $this->image;
     }

     /**
      * @param mixed $image
      */
     public function setImage($image): void
     {
         $this->image = $image;
         $image->setUser($this);
     }
 }
