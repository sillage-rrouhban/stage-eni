<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CvCvTitleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CvCvTitleRepository::class)]
#[ApiResource(
    denormalizationContext: ['groups'=>['write:cv:title']],
    normalizationContext: ['groups'=>['read:cv:title']],
)]
class CvTitle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'cvTitle', targetEntity: Cv::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['write:cv:title'])]
    private $cv;

    #[ORM\OneToOne(inversedBy: 'cvTitle', targetEntity: Title::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['write:cv:title', 'read:user'])]
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCv(): ?Cv
    {
        return $this->cv;
    }

    public function setCv(Cv $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getTitle(): ?Title
    {
        return $this->title;
    }

    public function setTitle(Title $title): self
    {
        $this->title = $title;

        return $this;
    }
}
