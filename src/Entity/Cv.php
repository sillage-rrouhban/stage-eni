<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateCvObjectAction;
use App\Repository\CVRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable()
 */
#[ORM\Entity(repositoryClass: CVRepository::class)]
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
    #[Groups(['read:cv','write:cv'])]
    private $file;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read:cv','write:cv'])]
    private $filename;


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
     * @return Cv
     */
    public function setFile(?File $file): Cv
    {
        $this->file = $file;
        return $this;
    }

}
