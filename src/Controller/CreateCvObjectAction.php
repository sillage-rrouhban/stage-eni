<?php

namespace App\Controller;

use App\Entity\Cv;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateCvObjectAction extends AbstractController
{
    public function __invoke(Request $request, EntityManagerInterface $entityManager): Cv
    {
        // Nous stockons le fichier envoyé dans une variable.
        $uploadedFile = $request->files->get('file');

        // Nous récupérons l'id de l'objet. Si il n'existe pas, l'id sera égal à null
        $id = $request->request->get('id');
        $userId = $request->request->get('user');

        // Si $uploadedFile est vide on renvoie une erreur et on arrête le code
        if (!$uploadedFile)
            throw new BadRequestHttpException('"file" is required');

        $cv = null;

        if ($id)
            $cv = $entityManager->getRepository(Cv::class)
                ->find($id);

        // On génère un nouvel objet CV qu'on stocke dans la variable $cv...
        if (!$cv)
            $cv = new Cv();

        $user = $entityManager->getRepository(User::class)
            ->find($userId);

        $cv->setFile($uploadedFile);
        $cv->setUser($user);

        return $cv;
    }

}
