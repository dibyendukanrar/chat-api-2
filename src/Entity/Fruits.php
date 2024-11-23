<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use App\Entity\Traits\CommonEntityTrait;
use App\Repository\FruitsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FruitsRepository::class)]
#[ApiResource(
    // operations: [
    //     new Get(),
    //     new Patch(),
    //     new Delete(),
    //     new GetCollection(),
    //     new Post(),
    // ]
)]
#[GetCollection()]
#[Get()]
#[POST(
    denormalizationContext: [
        'groups' => ['wantToExpose']
    ]
)]
#[HasLifecycleCallbacks]
class Fruits
{
    use CommonEntityTrait;

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
    #[Groups(['wantToExpose'])]
    private ?string $name = null;

    /**
     * This is description of the fruit
     */
    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(
        message: 'Description can\'t be blank.'
    )]
    #[Assert\Length(
        min: 15,
        max: 500,
        minMessage: 'Description should minimum {{ limit }} characters',
        maxMessage: 'Description should maximum {{ limit }} characters'
    )]
    #[Groups(['wantToExpose'])]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255)]
    #[Groups(['wantToExpose'])]
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

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
