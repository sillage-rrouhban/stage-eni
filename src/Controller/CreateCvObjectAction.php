<?php

namespace App\Controller;

use App\Entity\Cv;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;

class CreateCvObjectAction extends AbstractController
{
    public function __invoke(Request $request, EntityManagerInterface $entityManager): Cv {
        // Nous stockons le fichier envoyé dans une variable.
        $uploadedFile = $request->files->get('file');


        // Nous récupérons l'id de l'objet. Si il n'existe pas, l'id sera égal à null
        $id = $request->request->get('id');

        // Si $uploadedFile est vide on renvoie une erreur et on arrête le code
        if (!$uploadedFile)
            throw new BadRequestHttpException('"file" is required');

        // On crée une variable vide
        $cv = [];

        // Si l'id existe...
        if ($id) {
            // ...on récupère l'objet existant et on le stocke dans la variable $cv...
            $cv = $entityManager->getRepository(Cv::class)
                ->find($id);

            // Si l'id n'existe pas...
        } else {
            // On génère un nouvel objet CV qu'on stocke dans la variable $cv...
            $cv= new Cv();

        }
        $cv->setFile($uploadedFile);

        return $cv;
    }

}
