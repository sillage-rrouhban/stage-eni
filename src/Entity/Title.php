<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CvTitleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CvTitleRepository::class)]
#[ApiResource(
    denormalizationContext: ['groups'=>['write:title']],
    normalizationContext: ['groups'=>['read:title']],
)]
class Title
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:title', 'read:user'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read:title', 'read:user', 'write:title'])]
    private $label;

    #[ORM\OneToOne(mappedBy: 'title', targetEntity: CvTitle::class, cascade: ['persist', 'remove'])]
    private $cvTitle;

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

    public function getCvTitle(): ?CvTitle
    {
        return $this->cvTitle;
    }

    public function setCvTitle(CvTitle $cvTitle): self
    {
        // set the owning side of the relation if necessary
        if ($cvTitle->getTitle() !== $this) {
            $cvTitle->setTitle($this);
        }

        $this->cvTitle = $cvTitle;

        return $this;
    }
}
