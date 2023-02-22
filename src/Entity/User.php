<?php

namespace App\Entity;

use App\State\UserProvider;
use App\State\UserProcessor;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    formats: ["jsonld", "jsonhal"],
    paginationItemsPerPage: 5,
    operations: [
        new Get(
            provider: UserProvider::class,
            normalizationContext: [
                'groups' => ['get:user:item']
            ]
        ),
        new GetCollection(
            provider: UserProvider::class,
            normalizationContext: [
                'groups' => ['get:user:collection']
            ]
        ),
        new Post(
            processor: UserProcessor::class,
            normalizationContext: [
                'groups' => ['get:user:item']
            ],
            denormalizationContext: [
                'groups' => ['post:user']
            ],
            uriTemplate: '/users/create',
        ),
        new Delete(
            processor: UserProcessor::class,
            uriTemplate: '/users/{id}/delete',
        )
    ]
)]
#[UniqueEntity(fields:["email"])]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:user:item','get:user:collection', 'post:user'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get:user:item','get:user:collection', 'post:user'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get:user:item','get:user:collection', 'post:user'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups(['get:user:item','get:user:collection', 'post:user'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get:user:item', 'post:user'])]
    private ?string $phone = null;

    #[ORM\Column]
    #[Groups(['get:user:item', 'post:user'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['get:user:item'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}