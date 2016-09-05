<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/homepage.html.twig', [
        ]);
    }

    public function uploadAction(Request $request)
    {
        $files = $request->files->all();
        foreach($files as $no=>$file){
            $methods = get_class_methods($file);
            $data = array(
                ''
            );
        }
        $time = time();
        $response = new JsonResponse();
        $response->setData(array(
            'data' => 123,
            'test' => 'pizza',
            'source' => $this->getParameter('image_location')
        ));
        return $response;
    }
}
