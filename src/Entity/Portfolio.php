<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreatePortfolioObjectAction;
use App\Repository\PortfolioRepository;
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
#[ORM\Entity(repositoryClass: PortfolioRepository::class)]
#[HasLifecycleCallbacks]
#[ApiResource(
    collectionOperations: ['get',
        'post' => [
            'controller' => CreatePortfolioObjectAction::class,
            'deserialize' => false,
            'validation_groups' => ['Default', 'write:portfolio'],
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
        'patch'=>[
            'method'=>'POST',
            'controller' => CreatePortfolioObjectAction::class,
            'deserialize' => false,
            'validation_groups' => ['Default', 'write:portfolio'],
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
    denormalizationContext: ['groups'=>['write:portfolio']],
    normalizationContext: ['groups'=>['read:portfolio']],
)]
class Portfolio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @Vich\UploadableField(mapping="user_portfolio", fileNameProperty="filename")
     */
    private $file;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read:portfolio','write:portfolio'])]
    private $filename;

    #[ORM\Column(type: 'datetime_immutable')]
    private $uploadedAt;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

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
}
