<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text', nullable: true)]
    private $text;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $file_name;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'datetime')]
    private $datetime;

    #[ORM\Column(type: 'smallint')]
    private $status;

    #[ORM\ManyToMany(targetEntity: PublicPlace::class, inversedBy: 'posts')]
    private $public_places;

    public function __construct()
    {
        $this->public_places = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(?string $file_name): self
    {
        $this->file_name = $file_name;

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


    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, PublicPlace>
     */
    public function getPublicPlaces(): Collection
    {
        return $this->public_places;
    }

    public function addPublicPlace(PublicPlace $publicPlace): self
    {
        if (!$this->public_places->contains($publicPlace)) {
            $this->public_places[] = $publicPlace;
        }

        return $this;
    }

    public function removePublicPlace(PublicPlace $publicPlace): self
    {
        $this->public_places->removeElement($publicPlace);

        return $this;
    }
}
