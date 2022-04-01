<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ZipcodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ZipcodeRepository::class)]
#[ApiResource(
    collectionOperations: ['get','post'],
    itemOperations: ['get','patch','delete'],
    denormalizationContext: ['groups'=>['write:zipcode']],
    normalizationContext: ['groups' => ['read:zipcode']],
)]
class Zipcode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:zipcode', 'read:user'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:zipcode', 'read:user','write:zipcode'])]
    private $label;

    #[ORM\OneToMany(mappedBy: 'zipcode', targetEntity: City::class, orphanRemoval: true)]
    private $city;

    public function __construct()
    {
        $this->city = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, City>
     */
    public function getCity(): Collection
    {
        return $this->city;
    }

    public function addCity(City $city): self
    {
        if (!$this->city->contains($city)) {
            $this->city[] = $city;
            $city->setZipcode($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->city->removeElement($city)) {
            // set the owning side to null (unless already changed)
            if ($city->getZipcode() === $this) {
                $city->setZipcode(null);
            }
        }

        return $this;
    }

}
