<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CityRepository::class)]
#[ApiResource(
    collectionOperations: ['get','post'],
    itemOperations: ['get','patch','delete'],
    normalizationContext: ['groups' => ['read:city']],
)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:city', 'read:user'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:city', 'read:user'])]
    private $label;

    #[ORM\OneToMany(mappedBy: 'city', targetEntity: Address::class, orphanRemoval: true)]
    private $address;

    #[ORM\ManyToOne(targetEntity: Zipcode::class, inversedBy: 'city')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:user'])]
    private $zipcode;

    public function __construct()
    {
        $this->address = new ArrayCollection();
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
     * @return Collection<int, Address>
     */
    public function getAddress(): Collection
    {
        return $this->address;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->address->contains($address)) {
            $this->address[] = $address;
            $address->setCity($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->address->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getCity() === $this) {
                $address->setCity(null);
            }
        }

        return $this;
    }

    public function getZipcode(): ?Zipcode
    {
        return $this->zipcode;
    }

    public function setZipcode(?Zipcode $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }
}
