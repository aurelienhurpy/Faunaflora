<?php

namespace App\Controller;

use App\Entity\Prestations;
use App\Service\Pagination;
use App\Repository\PrestationsRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrestationsController extends AbstractController
{
    /**
     * Permet d'afficher une liste de prestation
     * @Route("/prestations{page<\d+>?1}", name="prestations_list")
     */
    public function index(PrestationsRepository $repo,Pagination $paginationService,$page){

        // via $repo, on va aller chercher toutes les prestations via la méthode findAll

        $paginationService->setEntityClass(Prestations::class)
                        ->setPage($page)
                        ->setLimit(3)
                        ;

        $prestations = $repo->findAll();

        return $this->render('prestations/index.html.twig', [
            'controller_name' => 'Prestations',
            'pagination'=>$paginationService,
            'prestations'=>$prestations
        ]);
    }

  

    /**
     *Permet d'afficher une seule prestation
     *@Route("/prestations/{id}", name="prestations_single")

     *@return Response
     */

    public function show($id,Prestations $prestations){

        
        return $this->render('prestations/show.html.twig',['prestations'=>$prestations]);

    }


}
