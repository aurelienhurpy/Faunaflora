<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use App\Service\Pagination;
use App\Repository\TeamRepository;
use App\Controller\AdminPartnerController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTeamController extends AbstractController
{
    /**
     * @Route("/admin/team\{page<\d+>?1}", name="admin_team_list")
     */
    public function index(TeamRepository $repo,$page,Pagination $paginationService)
    {
        $paginationService->setEntityClass(Team::class)
                        ->setPage($page)
                        //->setRoute('admin_team_list')
                        ;

        return $this->render('admin/team/index.html.twig', [
            'pagination'=>$paginationService

        ]);
    }

        /**
     * permet de creer un collaborateur
     * @Route("/admin/team/new",name="team_create")
     * @return response
     */

    public function create(Request $request,ObjectManager $manager){

        // fabrcant de formulaire : FORMBUILDER

        $team = new Team();

        // on lance la fabrication et la configuration de notre formulaire

        $form = $this->createForm(TeamType::class,$team);

        // recuperation des données du formulaire
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           
            $manager ->persist($team);
            $manager->flush();

            $this->addFlash('success',"Membre créé avec succès");

            return $this->redirectToRoute('admin_team_list',['slug'=>$team->getSlug()]);
        }

        return $this->render('admin/team/new.html.twig',['form'=>$form->createView()]);

    }

    /**
     * Permet de modifier un collaborateur dans la partie admin
     * @Route("admin/team/{id}/edit",name="admin_team_edit")
     * @param Team $team
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function edit(Team $team,Request $request,ObjectManager $manager){

        $form = $this->createForm(TeamType::class,$team);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($team);
            $manager->flush();

            $this->addFlash('success',"Le contenu membre a bien été modifiée");

            return $this->redirectToRoute('admin_team_list');

        }

        return $this->render('admin/team/edit.html.twig',[
            'team'=>$team,
            'form'=>$form->createView()
        ]);

    }

    /**
     * Suppression d un membre
     * @Route("/admin/team/{id}/delete",name="admin_team_delete")
     * @param Team $team
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Team $team,ObjectManager $manager){
     
        $manager->remove($team);
        $manager->flush();
    
        $this->addFlash('success',"Le membre <strong>{$team->getFirstname()}</strong> a bien été supprimé.");

        return $this->redirectToRoute("admin_team_list");}
    
    
       
}
