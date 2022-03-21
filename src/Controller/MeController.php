<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class MeController extends AbstractController
{
    public function __construct(private Security $security){}

    public function __invoke(): ?UserInterface
    {

        $user = $this->security->getUser();
        return $user;
    }

}
