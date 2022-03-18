<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route(path: '/auth_token', methods: ['POST'])]
    public function login(): JsonResponse
    {
        $user = $this->getUser();

        return $this->json([
            'user' => $user->getUserIdentifier(),
            'roles' => $user->getRoles()
        ]);
    }


    #[Route(path: '/api/logout', name: 'api_logout')]
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

}
