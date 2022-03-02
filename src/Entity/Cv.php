<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateCvObjectAction;
use App\Repository\CVRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CVRepository::class)]
#[ApiResource(
    collectionOperations: ['get',
        'post' => [
            'controller' => CreateCvObjectAction::class,
            'deserialize' => false,
            'validation_groups' => ['Default', 'media_object_create'],
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
    itemOperations: ['get','patch','delete'],
)]
class Cv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
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
}
