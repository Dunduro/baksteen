<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;

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
        $destination = $this->getParameter('image_location');
        /**
         * @var int $no
         * @var UploadedFile $file
         */
        foreach($files as $no=>$file)
        {

            $methods = get_class_methods($file);
            $file->move($destination,time().'_'.$file->getClientOriginalName());

        }
        $response = new JsonResponse();
        $response->setData(array(
            'data' => 123,
            'test' => 'pizza',
            'source' => $this->getParameter('image_location')
        ));
        return $response;
    }

    public function galleryAction(Request $request){
        $root = $this->getParameter('image_location');
        $files = new ArrayCollection();
        foreach(scandir($root) as $file){
            $test='';
            if(substr($file,0,1)!='.'){
                $files->add(new File($root.$file));
            }
        }
        return $this->render('default/gallery.html.twig', [
            'images'=>$files
        ]);
    }
}
