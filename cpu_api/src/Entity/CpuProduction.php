<?php

namespace App\Entity;

use App\Entity\Cpu;

use Doctrine\ORM\EntityManagerInterface;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CpuProductionRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CpuProductionRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['cpuProduction']],
    shortName: "cpuProduction",
    operations: [
        new Get(uriTemplate: '/cpuProduction/{id}'),
        new GetCollection(uriTemplate: '/cpuProduction'),
    ]
)]
class CpuProduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('cpuProduction')]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Groups('cpuProduction')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups('cpuProduction')]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups('cpuProduction')]
    private ?int $productionTime = null;

    # #[ORM\ManyToOne]
    #[ORM\ManyToOne(targetEntity: Cpu::class, inversedBy: 'cpuProductions')]
    #[Groups('cpuProduction')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cpu $cpu = null;

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

    public function getProductionTime(): ?int
    {
        return $this->productionTime;
    }

    public function setProductionTime(int $productionTime): static
    {
        $this->productionTime = $productionTime;

        return $this;
    }

    public function getCpu(): ?Cpu
    {
        return $this->cpu;
    }

    public function setCpu(?Cpu $cpu): static
    {
        $this->cpu = $cpu;

        return $this;
    }
}
