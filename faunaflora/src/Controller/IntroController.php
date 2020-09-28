<?php

namespace App\Controller;

use App\Entity\Intro;
use App\Repository\IntroRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IntroController extends AbstractController
{
    /**
     * @Route("/intro{page<\d+>?1}", name="intro")
     */
    

    public function home(IntroRepository $introRepo){

        return $this->render('intro/index.html.twig',[
            'intro'=>$introRepo->findAll()
           
            ]);

    }
}