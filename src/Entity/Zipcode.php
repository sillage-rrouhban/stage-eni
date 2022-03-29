<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ZipcodeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ZipcodeRepository::class)]
#[ApiResource(
    collectionOperations: ['get','post'],
    itemOperations: ['get','patch','delete'],
)]
class Zipcode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:address'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:address'])]
    private $label;

    #[ORM\OneToOne(targetEntity: City::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:address'])]
    private $city;

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

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(City $city): self
    {
        $this->city = $city;

        return $this;
    }
}
