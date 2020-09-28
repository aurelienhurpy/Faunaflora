<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Service\Pagination;
use App\Repository\NewsRepository;
use App\Controller\AdminNewsController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminNewsController extends AbstractController
{
    /**
     * @Route("/admin/news\{page<\d+>?1}", name="admin_news_list")
     */
    public function index(NewsRepository $repo,$page,Pagination $paginationService)
    {
        $paginationService->setEntityClass(News::class)
                        ->setPage($page)
                        //->setRoute('admin_news_list')
                        ;

        return $this->render('admin/news/index.html.twig', [
            'pagination'=>$paginationService

        ]);
    }

        /**
     * permet de creer une annonce
     * @Route("/admin/news/new",name="news_create")
     * @return response
     */

    public function create(Request $request,ObjectManager $manager){

        // fabrcant de formulaire : FORMBUILDER

        $news = new News();

        // on lance la fabrication et la configuration de notre formulaire

        $form = $this->createForm(NewsType::class,$news);

        // recuperation des données du formulaire
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           
            $manager ->persist($news);
            $manager->flush();

            $this->addFlash('success',"Page d'actualité' créée avec succès");

            return $this->redirectToRoute('admin_news_list',['slug'=>$news->getSlug()]);
        }

        return $this->render('admin/news/new.html.twig',['form'=>$form->createView()]);

    }

    /**
     * Permet de modifier une actualité dans la partie admin
     * @Route("admin/news/{id}/edit",name="admin_news_edit")
     * @param News $news
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function edit(News $news,Request $request,ObjectManager $manager){

        $form = $this->createForm(NewsType::class,$news);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($news);
            $manager->flush();

            $this->addFlash('success',"La page d'actualités a bien été modifiée");

            return $this->redirectToRoute('admin_news_list');

        }

        return $this->render('admin/news/edit.html.twig',[
            'news'=>$news,
            'form'=>$form->createView()
        ]);

    }

    /**
     * Suppression d une annonce
     * @Route("/admin/news/{id}/delete",name="admin_news_delete")
     * @param News $news
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(News $news,ObjectManager $manager){
     
        $manager->remove($news);
        $manager->flush();
    
        $this->addFlash('success',"L'actuaté <strong>{$news->getTitle()}</strong> a bien été supprimée.");

        return $this->redirectToRoute("admin_news_list");}
    
    
       
}
