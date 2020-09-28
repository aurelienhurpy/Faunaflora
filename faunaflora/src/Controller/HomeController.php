<?php

// namespace : chemin du controller

namespace App\Controller;

use App\Service\Pagination;
use App\Repository\NewsRepository;
use App\Repository\TeamRepository;
use App\Repository\IntroRepository;
use App\Repository\AdressesRepository;
use App\Repository\PrestationsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    /**
     * création premiere route
     * @Route("/", name="homepage")
     */

    public function home(IntroRepository $introRepo,NewsRepository $newsRepo,TeamRepository $teamRepo,PrestationsRepository $prestationsRepo,AdressesRepository $adressesRepo){

        return $this->render('home.html.twig',[
            'intro'=>$introRepo->findAll(),
            'news'=>$newsRepo->findAll(),
            'team'=>$teamRepo->findAll(),
            'prestations'=>$prestationsRepo->findall(),
            'adresses'=>$adressesRepo->findall()
           
            ]);

    }

}