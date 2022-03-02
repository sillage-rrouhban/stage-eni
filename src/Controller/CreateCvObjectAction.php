<?php

namespace App\Controller;

use App\Entity\Cv;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\HttpFoundation\Request;

class CreateCvObjectAction extends AbstractController
{
    public function __invoke(Request $request): Cv {


        $cv = $request->files->get('file');
        dd($cv);
        if(!($cv instanceof Cv)){
            throw new RuntimeException('file is required');
        }
      //  $uploadedFile = $request->files->get('file');
        $cv->setFile($request->files->get('file'));
        return $cv;
    }

}
