<?php

namespace App\Controller;

use App\Entity\Prestations;
use App\Form\PrestationsType;
use App\Service\Pagination;
use App\Repository\PrestationsRepository;
use App\Controller\AdminPrestationsController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPrestationsController extends AbstractController
{
    /**
     * @Route("/admin/prestations\{page<\d+>?1}", name="admin_prestations_list")
     */
    public function index(PrestationsRepository $repo,$page,Pagination $paginationService)
    {
        $paginationService->setEntityClass(Prestations::class)
                        ->setPage($page)
                        //->setRoute('admin_prestations_list')
                        ;

        return $this->render('admin/prestations/index.html.twig', [
            'pagination'=>$paginationService

        ]);
    }

        /**
     * permet de creer une prestation
     * @Route("/admin/prestations/new",name="prestation_create")
     * @return response
     */

    public function create(Request $request,ObjectManager $manager){

        // fabrcant de formulaire : FORMBUILDER

        $prestations = new Prestations();

        // on lance la fabrication et la configuration de notre formulaire

        $form = $this->createForm(PrestationsType::class,$prestations);

        // recuperation des données du formulaire
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           
            $manager ->persist($prestations);
            $manager->flush();

            $this->addFlash('success',"Page prestation créée avec succès");

            return $this->redirectToRoute('admin_prestations_list',['slug'=>$prestations->getSlug()]);
        }

        return $this->render('admin/prestations/new.html.twig',['form'=>$form->createView()]);

    }

    /**
     * Permet de modifier une actualité dans la partie admin
     * @Route("admin/prestations/{id}/edit",name="admin_prestations_edit")
     * @param Prestations $prestations
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function edit(Prestations $prestations,Request $request,ObjectManager $manager){

        $form = $this->createForm(PrestationsType::class,$prestations);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($prestations);
            $manager->flush();

            $this->addFlash('success',"La prestation a bien été modifiée");

            return $this->redirectToRoute('admin_prestations_list');

        }

        return $this->render('admin/prestations/edit.html.twig',[
            'prestations'=>$prestations,
            'form'=>$form->createView()
        ]);

    }

    /**
     * Suppression d une prestation
     * @Route("/admin/prestations/{id}/delete",name="admin_prestations_delete")
     * @param Prestations $prestation
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Prestations $prestations,ObjectManager $manager){
     
        $manager->remove($prestations);
        $manager->flush();
    
        $this->addFlash('success',"La prestation <strong></strong> a bien été supprimée.");

        return $this->redirectToRoute("admin_prestations_list");}
    
    
       
}
