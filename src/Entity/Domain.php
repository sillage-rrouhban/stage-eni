<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DomainRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DomainRepository::class)]
#[ApiResource(
    collectionOperations: ['get','post'],
    itemOperations: ['get'],
    denormalizationContext: ['groups' => ['write:domain']],
    normalizationContext: ['groups' => ['read:domain']],
)]
class Domain
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:domain'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:domain', 'write:domain'])]
    private $label;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }
}
