<?php

namespace App\Controller;

use App\Entity\Cv;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CreateCvObjectAction extends AbstractController
{
    public function __invoke(Request $request): Cv {
        dd($request->attributes);
        $uploadedFile = $request->files->get('file');
        dd($uploadedFile, $cv);
    }

}
