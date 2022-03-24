<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\MeController;
use App\Repository\UserRepository;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use JetBrains\PhpStorm\Pure;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[HasLifecycleCallbacks]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    collectionOperations: ['get', 'post',
        'me'=>[
        'pagination_enable'=> false,
        'path'=> '/me',
        'method'=>'get',
        'controller'=> MeController::class,
        'read'=> false,
    ],
        ],
    itemOperations: ['get'=>[
        'controller' => NotFoundAction::class,
        'openapi_context' =>['summary'=> 'hidden'],
        'read' => false,
        'output' => false
    ],
        'put', 'delete'],
    denormalizationContext: ['groups' => ['write:user']],
    normalizationContext: ['groups' => ['read:user']],
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface, JWTUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:user'])]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Groups(['read:user', 'write:user'])]
    private $email;

    #[ORM\Column(type: 'json')]
    #[Groups(['read:user', 'write:user'])]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\ManyToOne(targetEntity: Type::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['write:user'])]
    private $type;

    #[Groups(['write:user'])]
    private $plainPassword;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['read:user'])]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['read:user'])]
    private $updatedAt;

    private $tokenExp;

    private $typeId;

    /**
     * @return mixed
     */
    #[Groups(['read:user'])]
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param mixed $typeId
     * @return User
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
        return $this;
    }

    #[ORM\Column(type: 'boolean')]
    private $isVerified;

    /**
     * @return mixed
     */
    #[Groups(['read:user'])]
    public function getTokenExp()
    {
        return $this->tokenExp;
    }

    /**
     * @param mixed $tokenExp
     * @return User
     */
    public function setTokenExp($tokenExp)
    {
        $this->tokenExp = $tokenExp;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[PrePersist]
    public function onPrePersist(LifecycleEventArgs $eventArgs)
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[PreUpdate]
    public function onPreUpdate(LifecycleEventArgs $eventArgs)
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[Pure] public function getUsername(): string
    {
        return $this->getUserIdentifier();
    }



    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }


    public static function createFromPayload($username, array $payload): User|JWTUserInterface
    {
        //dd($payload);
        return (new User())
            ->setId($payload['id'])
            ->setEmail($username)
            ->setRoles($payload['roles'])
            ->setTypeId($payload['id'])
            ->setTokenExp($payload['exp']);

    }
}
