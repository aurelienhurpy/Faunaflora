<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Service\Pagination;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminContactController extends AbstractController
{
    /**
     * Affiche la liste des contacts
     * @Route("/admin/contact/{page<\d+>?1}", name="admin_contact_list")
     * @return Response
     */
    public function index(ContactRepository $repo,Pagination $paginationService,$page)
    {
        $paginationService->setEntityClass(Contact::class)
                            ->setPage($page)
                            //->setRoute('admin_contact_list')
                            ;

        return $this->render('admin/contact/index.html.twig', [
            'pagination' => $paginationService
        ]);
    }

   

    /**
     * Permet d'afficher un seul contact
     * @Route("/admin/contact/{id}/show",name="admin_contact_single")
     * @param Contact $contact
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function show(Contact $contact,Request $request,ObjectManager $manager){

        $contact->setIsRead(true);

        $manager->persist($contact);
        $manager->flush();

        return $this->render('admin/contact/show.html.twig',['contact'=>$contact]);

    }

    

    /**
     * Suppression d un contact
     * @Route("/admin/contact/{id}/delete",name="admin_contact_delete")
     * @param Contact $contact
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Contact $contact,ObjectManager $manager){

        $manager->remove($contact);
        $manager->flush();

        $this->addFlash('success',"Demande de contact supprimé avec succès.");

        return $this->redirectToRoute('admin_contact_list');

    }

}
