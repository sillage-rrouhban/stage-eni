<?php

namespace App\Controller;

use App\Entity\Cv;
use Symfony\Component\HttpFoundation\Request;

class CvFileController
{
    public function __invoke(Request $request){
        dd($request->attributes);
        $file = $request->files->get('file');
        dd($file,$cv);
    }

}