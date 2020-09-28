<?php

namespace App\Controller;

use App\Entity\Team;
use App\Service\Pagination;
use App\Repository\TeamRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamController extends AbstractController
{
    /**
     * Permet d'afficher une liste de l equipe
     * @Route("/team{page<\d+>?1}", name="team")
     */
    public function index(TeamRepository $repo,Pagination $paginationService,$page){

        // via $repo, on va aller chercher toutes les news via la méthode findAll

        $paginationService->setEntityClass(Team::class)
                        ->setPage($page)
                        ->setLimit(3)
                        ;

        $team = $repo->findAll();

        return $this->render('team/index.html.twig', [
            'controller_name' => 'Equipe',
            'pagination'=>$paginationService,
            'team'=>$team
        ]);
    }

  

    /**
     *Permet d'afficher une seule annonce
     *@Route("/team/{id}", name="team_single")

     *@return Response
     */

    public function show($id,Team $team){


        return $this->render('team/show.html.twig',['team'=>$team]);

    }


}