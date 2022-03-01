<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class UserDataPersister implements ContextAwareDataPersisterInterface
{
    private $passwordHasher;
    private $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $entityManager)
    {
        $this->passwordHasher= $passwordHasher;
        $this->entityManager = $entityManager;

    }


    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function persist($data, array $context = [])
    {
       if($data->getPlainPassword()){
            $password = $this->passwordHasher->hashPassword($data, $data->getPlainPassword());
            $data->setPassword($password);
        }
       $this->entityManager->persist($data);
       $this->entityManager->flush();


    }

    public function remove($data, array $context = [])
    {
        // TODO: Implement remove() method.
    }




}