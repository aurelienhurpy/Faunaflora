<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Service\Pagination;
use App\Repository\PartnerRepository;
use App\Controller\AdminPartnerController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPartnerController extends AbstractController
{
    /**
     * @Route("/admin/partner\{page<\d+>?1}", name="admin_partner_list")
     */
    public function index(PartnerRepository $repo,$page,Pagination $paginationService)
    {
        $paginationService->setEntityClass(Partner::class)
                        ->setPage($page)
                        //->setRoute('admin_partner_list')
                        ;

        return $this->render('admin/partner/index.html.twig', [
            'pagination'=>$paginationService

        ]);
    }

        /**
     * permet de creer un partenaire
     * @Route("/admin/partner/new",name="partner_create")
     * @return response
     */

    public function create(Request $request,ObjectManager $manager){

        // fabrcant de formulaire : FORMBUILDER

        $partner = new Partner();

        // on lance la fabrication et la configuration de notre formulaire

        $form = $this->createForm(PartnerType::class,$partner);

        // recuperation des données du formulaire
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           
            $manager ->persist($partner);
            $manager->flush();

            $this->addFlash('success',"Partenaire' créé avec succès");

            return $this->redirectToRoute('admin_partner_list',['slug'=>$partner->getSlug()]);
        }

        return $this->render('admin/partner/new.html.twig',['form'=>$form->createView()]);

    }

    /**
     * Permet de modifier un partenaire dans la partie admin
     * @Route("admin/partner/{id}/edit",name="admin_partner_edit")
     * @param Partner $partner
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function edit(Partner $partner,Request $request,ObjectManager $manager){

        $form = $this->createForm(PartnerType::class,$partner);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($partner);
            $manager->flush();

            $this->addFlash('success',"Le contenu partenaire a bien été modifiée");

            return $this->redirectToRoute("admin_partner_list");

        }

        return $this->render('admin/partner/edit.html.twig',[
            'partner'=>$partner,
            'form'=>$form->createView()
        ]);

    }

    /**
     * Suppression d un partenaire
     * @Route("/admin/partner/{id}/delete",name="admin_partner_delete")
     * @param Partner $partner
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Partner $partner,ObjectManager $manager){
     
        $manager->remove($partner);
        $manager->flush();
    
        $this->addFlash('success',"Le partenaire <strong>{$partner->getName()}</strong> a bien été supprimé.");

        return $this->redirectToRoute("admin_partner_list");}
    
    
       
}
