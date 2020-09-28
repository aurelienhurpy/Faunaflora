<?php

namespace App\Controller;

use App\Entity\Intro;
use App\Form\IntroType;
use App\Service\Pagination;
use App\Repository\IntroRepository;
use App\Controller\AdminIntroController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminIntroController extends AbstractController
{
    /**
     * @Route("/admin/intro\{page<\d+>?1}", name="admin_intro_list")
     */
    public function index(IntroRepository $repo,$page,Pagination $paginationService)
    {
        $paginationService->setEntityClass(Intro::class)
                        ->setPage($page)
                        //->setRoute('admin_intro_list')
                        ;

        return $this->render('admin/intro/index.html.twig', [
            'pagination'=>$paginationService

        ]);
    }

        /**
     * permet de creer une annonce
     * @Route("/admin/intro/new",name="intro_create")
     * @return response
     */

    public function create(Request $request,ObjectManager $manager){

        // fabrcant de formulaire : FORMBUILDER

        $intro = new Intro();

        // on lance la fabrication et la configuration de notre formulaire

        $form = $this->createForm(IntroType::class,$intro);

        // recuperation des données du formulaire
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // si le fomulaire est soumis Et si le formulaire est valide, on demande à doctrine de sauvegarder ces données dans l'objet manager( dans la bdd)
            //pour chaque image supplémentaire ajoutée

            // foreach($intro->getCoverImage() as $image){

            //     // on relie l'image à l'annonce et on modifie l'annonce
            //     $image->setIntro($intro);

            //     // on sauvegarde les images

            //     $manager->persist($image);
            // }

           
            $manager ->persist($intro);
            $manager->flush();

            $this->addFlash('success',"Page de présentation créée avec succès");

            return $this->redirectToRoute('admin_intro_list',['slug'=>$intro->getSlug()]);
        }

        return $this->render('admin/intro/new.html.twig',['form'=>$form->createView()]);

    }

    /**
     * Permet de modifier une annonce dans la partie admin
     * @Route("admin/intro/{id}/edit",name="admin_intro_edit")
     * @param Intro $intro
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function edit(Intro $intro,Request $request,ObjectManager $manager){

        $form = $this->createForm(IntroType::class,$intro);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($intro);
            $manager->flush();

            $this->addFlash('success',"La page de présentation a bien été modifiée");

            return $this->redirectToRoute('admin_intro_list');

        }

        return $this->render('admin/intro/edit.html.twig',[
            'intro'=>$intro,
            'form'=>$form->createView()
        ]);

    }

       
}
