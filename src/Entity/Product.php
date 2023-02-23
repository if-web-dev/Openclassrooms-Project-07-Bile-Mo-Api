<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    formats: ["jsonhal", "jsonld"],
    paginationItemsPerPage: 5,
    operations: [
        new Get(
            normalizationContext: [
                'groups' => ['get:product:item']
            ],
            openapiContext: [
                'responses' => [
                    '200' => ['description' => 'Product resource.'],
                    '400' => ['description' => 'Bad request.'],
                    '401' => ['description' => 'Authentication is required.'],
                    '403' => ['description' => 'Invalid JWT token.'],
                    '404' => ['description' => 'Product resource not found.'],
                ]
            ]
        ),
        new GetCollection(
            normalizationContext: [
                'groups' => ['get:product:collection']
            ],
            openapiContext: [
                'responses' => [
                    '200' => ['description' => 'Products collection.'],
                    '400' => ['description' => 'Bad request.'],
                    '401' => ['description' => 'Authentication is required.'],
                    '403' => ['description' => 'Invalid JWT token.'],
                    '404' => ['description' => 'Product resource not found.'],
                ]
            ]
        )
    ]
)]
#[UniqueEntity(fields: ['sku'])]
#[UniqueEntity(fields: ['model'])]
class Product
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[Groups(['get:product:item','get:product:collection'])]
    private ?int $id = null;

    /**
     * Stock Keeping Unit (a.k.a. bar code)
     */
    #[ORM\Column(length: 255, unique: true)]
    #[Groups(['get:product:item','get:product:collection'])]
    #[Assert\Length(
        min: 8,
        minMessage: 'The sku must be at least {{ limit }} characters long',
        max: 16,
        maxMessage: 'The sku cannot be longer than {{ limit }} characters'
    )]
    private ?string $sku = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get:product:item','get:product:collection'])]
    #[Assert\NotBlank]
    #[Assert\NotNull(message: '{{ label }} is empty, please enter a value.')]
    #[Assert\Length(
        min: 2,
        minMessage: 'The brand must be at least {{ limit }} characters long',
        max: 50,
        maxMessage: 'The brand cannot be longer than {{ limit }} characters'
    )]
    private ?string $brand = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups(['get:product:item','get:product:collection'])]
    #[Assert\NotBlank]
    #[Assert\NotNull(message: '{{ label }} is empty, please enter a value.')]
    #[Assert\Length(
        min: 2,
        minMessage: 'The model must be at least {{ limit }} characters long.',
        max: 50,
        maxMessage: 'The model cannot be longer than {{ limit }} characters.'
    )]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get:product:item'])]
    #[Assert\Length(
        min: 1,
        minMessage: 'The description must be at least {{ limit }} characters long.',
        max: 255,
        maxMessage: 'The description cannot be longer than {{ limit }} characters'
    )]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['get:product:item'])]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}