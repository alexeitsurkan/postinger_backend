<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $platform;

    #[ORM\Column(type: 'string', length: 255)]
    private $sid;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'accounts')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $access_token;

    #[ORM\OneToMany(mappedBy: 'account', targetEntity: PublicPlace::class, orphanRemoval: true)]
    private $publicPlaces;

    public function __construct()
    {
        $this->publicPlaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlatform(): ?int
    {
        return $this->platform;
    }

    public function setPlatform(int $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function getSid(): ?string
    {
        return $this->sid;
    }

    public function setSid(string $sid): self
    {
        $this->sid = $sid;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAccessToken(): ?string
    {
        return $this->access_token;
    }

    public function setAccessToken(?string $access_token): self
    {
        $this->access_token = $access_token;

        return $this;
    }

    /**
     * @return Collection<int, PublicPlace>
     */
    public function getPublicPlaces(): Collection
    {
        return $this->publicPlaces;
    }

    public function addPublicPlace(PublicPlace $publicPlace): self
    {
        if (!$this->publicPlaces->contains($publicPlace)) {
            $this->publicPlaces[] = $publicPlace;
            $publicPlace->setAccount($this);
        }

        return $this;
    }

    public function removePublicPlace(PublicPlace $publicPlace): self
    {
        if ($this->publicPlaces->removeElement($publicPlace)) {
            // set the owning side to null (unless already changed)
            if ($publicPlace->getAccount() === $this) {
                $publicPlace->setAccount(null);
            }
        }

        return $this;
    }
}
