<?php

namespace App\Controller;

use App\Entity\Portfolio;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

class CreatePortfolioObjectAction extends AbstractController
{
    public function __invoke(Request $request, EntityManagerInterface $entityManager): Portfolio
    {

        $uploadedFile = $request->files->get('file');

        $id = $request->attributes->get('id');

        if (!$uploadedFile) {
            throw new BadRequestException('"file" is required');
        }

        $portfolio = null;

        if ($id) {
            $portfolio = $entityManager->getRepository(Portfolio::class)
                ->find($id);
        }

        if (!$portfolio) {
            $portfolio = new Portfolio();
        }

        $portfolio->setFile($uploadedFile);

        return $portfolio;
    }

}