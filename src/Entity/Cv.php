<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CvFileController;
use App\Repository\CVRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CVRepository::class)]
#[ApiResource(
    collectionOperations: ['get','post'],
    itemOperations: ['get','patch','delete',
        'file'=>[
            'method'=>'POST',
            'path'=>'/cvs/{id}/file',
            'deserialize'=>false,
            'controller'=>CvFileController::class
        ]
        ],

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
