<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailViewerController extends AbstractController
{
    #[Route('/email/viewer', name: 'app_email_viewer')]
    public function index(): Response
    {
        return $this->render('email_viewer/index.html.twig');
    }
}
