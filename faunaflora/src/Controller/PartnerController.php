<?php

namespace App\Controller;


use App\Repository\PartnerRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PartnerController extends AbstractController
{
    /**
     * @Route("/partner{page<\d+>?1}", name="partner")
     */
    

    public function home(PartnerRepository $partnerRepo){

        return $this->render('partner/index.html.twig',[
            'partner'=>$partnerRepo->findAll()
           
            ]);

    }
}