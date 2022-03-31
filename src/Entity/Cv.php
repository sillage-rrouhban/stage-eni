<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateCvObjectAction;
use App\Repository\CVRepository;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable()
 */
#[ORM\Entity(repositoryClass: CVRepository::class)]
#[HasLifecycleCallbacks]
#[ApiResource(
    collectionOperations: ['get',
        'post' => [
            'controller' => CreateCvObjectAction::class,
            'deserialize' => false,
            'validation_groups' => ['Default', 'write:cv'],
            'openapi_context' => [
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    itemOperations: ['get', 'delete',
        'patch' => [
            'method'=>'POST',
            'controller' => CreateCvObjectAction::class,
            'deserialize' => false,
            'validation_groups' => ['Default', 'write:cv'],
            'openapi_context' => [
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    denormalizationContext: ['groups'=>['write:cv']],
    normalizationContext: ['groups'=>['read:cv']],
)]
class Cv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @Vich\UploadableField(mapping="user_cv", fileNameProperty="filename")
     */
    private $file;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read:cv','write:cv','read:user'])]
    private $filename;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['read:user'])]
    private $uploadedAt;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['write:cv'])]
    private $user;

    #[ORM\OneToOne(mappedBy: 'cv', targetEntity: Cv::class, cascade: ['persist', 'remove'])]
    #[Groups(['read:user'])]
    private $cvTitle;
    


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File|null $file
     */
    public function setFile(?File $file = null): void
    {
        $this->file = $file;

        if (null !== $file) {
            $this->uploadedAt = new \DateTimeImmutable();
        }
    }

    public function getUploadedAt(): ?\DateTimeInterface
    {
        return $this->uploadedAt;
    }

    public function setUploadedAt(\DateTimeImmutable $uploadedAt): self
    {
        $this->uploadedAt = $uploadedAt;

        return $this;
    }

    #[PrePersist]
    public function onPrePersist(LifecycleEventArgs $eventArgs)
    {
        $this->uploadedAt = new \DateTimeImmutable();
    }

    #[PreUpdate]
    public function onPreUpdate(LifecycleEventArgs $eventArgs)
    {
        $this->uploadedAt = new \DateTimeImmutable();
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCvTitle(): ?CvTitle
    {
        return $this->cvTitle;
    }

    public function setCvTitle(CvTitle $cvTitle): self
    {
        // set the owning side of the relation if necessary
        if ($cvTitle->getCv() !== $this) {
            $cvTitle->setCv($this);
        }

        $this->cvTitle = $cvTitle;

        return $this;
    }
    
    
}
