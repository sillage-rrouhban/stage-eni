<?php

namespace App\Controller;

use App\Entity\Logo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateLogoObjectAction extends AbstractController
{
    public function __invoke(Request $request, EntityManagerInterface $entityManager): Logo
    {
        $uploadedFile = $request->files->get('file');

        $id = $request->attributes->get('id');

        if (!$uploadedFile) {
            throw new BadRequestHttpException("file is required");
        }

        $logo = null;

        if ($id) {
            $logo = $entityManager->getRepository(Logo::class)
                ->find($id);
        }

        if (!$logo) {
            $logo = new Logo();
        }

        $logo->setFile($uploadedFile);

        return $logo;
    }

}