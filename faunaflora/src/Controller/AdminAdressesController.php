<?php

namespace App\Controller;

use App\Entity\Adresses;
use App\Form\AdressesType;
use App\Service\Pagination;
use App\Repository\AdressesRepository;
use App\Controller\AdminAdressesController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAdressesController extends AbstractController
{
    /**
     * @Route("/admin/adresses\{page<\d+>?1}", name="admin_adresses_list")
     */
    public function index(AdressesRepository $repo,$page,Pagination $paginationService)
    {
        $paginationService->setEntityClass(Adresses::class)
                        ->setPage($page)
                        //->setRoute('admin_adresses_list')
                        ;

        return $this->render('admin/adresses/index.html.twig', [
            'pagination'=>$paginationService

        ]);
    }

        /**
     * permet de creer les infos adresses
     * @Route("/admin/adresses/new",name="adresses_create")
     * @return response
     */

    public function create(Request $request,ObjectManager $manager){

        // fabrcant de formulaire : FORMBUILDER

        $adresses = new Adresses();

        // on lance la fabrication et la configuration de notre formulaire

        $form = $this->createForm(AdressesType::class,$adresses);

        // recuperation des données du formulaire
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           
            $manager ->persist($adresses);
            $manager->flush();

            $this->addFlash('success',"Page d'information' créée avec succès");

            return $this->redirectToRoute('admin_adresses_list',['slug'=>$adresses->getSlug()]);
        }

        return $this->render('admin/adresses/new.html.twig',['form'=>$form->createView()]);

    }

    /**
     * Permet de modifier les infos adresses
     * @Route("admin/adresses/{id}/edit",name="admin_adresses_edit")
     * @param Adresses $adresses
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function edit(Adresses $adresses,Request $request,ObjectManager $manager){

        $form = $this->createForm(AdressesType::class,$adresses);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($adresses);
            $manager->flush();

            $this->addFlash('success',"La page d'information a bien été modifiée");

            return $this->redirectToRoute('admin_adresses_list');

        }

        return $this->render('admin/adresses/edit.html.twig',[
            'adresses'=>$adresses,
            'form'=>$form->createView()
        ]);

    }

    
    
       
}
