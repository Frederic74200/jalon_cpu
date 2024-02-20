<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CpuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: CpuRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['cpu']],
    shortName: "cpu",
    operations: [
        new Get(uriTemplate: '/cpu/{id}'),
        new GetCollection(uriTemplate: '/cpu'),
        new Post(uriTemplate: '/cpu'),
        new Put(uriTemplate: '/cpu/{id}'),

    ]
)]
class Cpu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('cpu')]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Groups('cpu')]
    private ?string $model = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 1)]
    #[Groups('cpu')]
    private ?string $ghz = null;

    #[ORM\Column]
    #[Groups('cpu')]
    private ?int $price = null;

    #[ORM\Column(length: 10)]
    #[Groups('cpu')]
    private ?string $brand = null;

    #[ORM\Column(length: 20)]
    #[Groups('cpu')]
    private ?string $family = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getGhz(): ?string
    {
        return $this->ghz;
    }

    public function setGhz(string $ghz): static
    {
        $this->ghz = $ghz;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): static
    {
        $this->family = $family;

        return $this;
    }
}
