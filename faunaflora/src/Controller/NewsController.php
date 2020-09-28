<?php

namespace App\Controller;

use App\Entity\News;
use App\Service\Pagination;
use App\Repository\NewsRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{
    /**
     * Permet d'afficher une liste d'annonces
     * @Route("/news{page<\d+>?1}", name="news_list")
     */
    public function index(NewsRepository $repo,Pagination $paginationService,$page){

        // via $repo, on va aller chercher toutes les news via la méthode findAll

        $paginationService->setEntityClass(News::class)
                        ->setPage($page)
                        ->setLimit(3)
                        ;

        $news = $repo->findAll();

        return $this->render('news/index.html.twig', [
            'controller_name' => 'Travaux',
            'pagination'=>$paginationService,
            'news'=>$news
        ]);
    }

  

    /**
     *Permet d'afficher une seule annonce
     *@Route("/news/{id}", name="news_single")

     *@return Response
     */

    public function show($id,News $news){

        // je recupere l'annonce qui correspond au slug (alias)
        // X = 1 champ de la table, à préciser à la place de X
        //findByX = renvoi un tableau d'annonces (plusieurs elements)
        //findOneByX = renvoi à un élément

        //$ad = $repo->findOneBySlug($slug);
        return $this->render('news/show.html.twig',['news'=>$news]);

    }


}
