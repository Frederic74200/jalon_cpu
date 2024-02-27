<?php

namespace App\Entity;

use App\Entity\CpuProduction;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CpuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CpuRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['cpu']],
    shortName: "cpu",
    operations: [
        new Get(uriTemplate: '/cpu/{id}'),
        new GetCollection(uriTemplate: '/cpu'),
        new Post(uriTemplate: '/cpu'),
        new Patch(uriTemplate: '/cpu/{id}'),

    ]
)]
class Cpu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]

    #[Groups('cpu')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Groups('cpu')]
    private ?string $model = null;

    #[ORM\Column]
    #[Groups('cpu')]
    private ?float $ghz = null;

    #[ORM\Column]
    #[Groups('cpu')]
    private ?int $price = null;

    #[ORM\Column(length: 10)]
    #[Groups('cpu')]
    private ?string $brand = null;

    #[ORM\Column(length: 20)]
    #[Groups('cpu')]
    private ?string $family = null;

    #[ORM\Column(nullable: true)]
    #[Groups('cpu')]
    private ?int $stock = null;

    #[ORM\OneToMany(mappedBy: 'cpu', targetEntity: CpuProduction::class)]
    private Collection $cpuProductions;

    public function __construct()
    {
        $this->cpuProductions = new ArrayCollection();
    }

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

    public function getGhz(): ?float
    {
        return $this->ghz;
    }

    public function setGhz(float $ghz): static
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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, CpuProduction>
     */
    public function getCpuProductions(): Collection
    {
        return $this->cpuProductions;
    }

    public function addCpuProduction(CpuProduction $cpuProduction): static
    {
        if (!$this->cpuProductions->contains($cpuProduction)) {
            $this->cpuProductions->add($cpuProduction);
            $cpuProduction->setCpu($this);
        }

        return $this;
    }

    public function removeCpuProduction(CpuProduction $cpuProduction): static
    {
        if ($this->cpuProductions->removeElement($cpuProduction)) {
            // set the owning side to null (unless already changed)
            if ($cpuProduction->getCpu() === $this) {
                $cpuProduction->setCpu(null);
            }
        }

        return $this;
    }
}
