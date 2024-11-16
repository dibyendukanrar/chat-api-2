<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use App\Repository\FruitsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FruitsRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        // new Patch(),
        // new Delete(),
        // new GetCollection(),
        new Post(),
    ]
)]
#[HasLifecycleCallbacks]
class Fruits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * This is name of the fruit
     */
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: 'Name can\'t be blank.'
    )]
    #[Assert\Length(
        min: 5,
        max: 100,
        minMessage: 'Name should minimum {{ limit }} characters',
        maxMessage: 'Name should maximum {{ limit }} characters'
    )]
    private ?string $name = null;

    /**
     * This is description of the fruit
     */
    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(
        message: 'Description can\'t be blank.'
    )]
    #[Assert\Length(
        min: 30,
        max: 500,
        minMessage: 'Description should minimum {{ limit }} characters',
        maxMessage: 'Description should maximum {{ limit }} characters'
    )]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
