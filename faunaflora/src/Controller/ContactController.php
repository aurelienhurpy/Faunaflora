<?php

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AdressesRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ContactController extends AbstractController
{
    /**
     * Permet d'afficher le formulaire de contact
     * @Route("/contact",name="contact_create")
     
     * 
     * @return Response
     */

    public function contact(Request $request,ObjectManager $manager,AdressesRepository $adressesRepo)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class,$contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
 

                $manager->persist($contact);
                $manager->flush();

                $this->addFlash('success',"Demande de contact créée avec succès");
    
                return $this->redirectToRoute("homepage");
                
            }
                    return $this->render('contact/contact.html.twig', ['form'=>$form->createView(),'adresses'=>$adressesRepo->findall()]);

        }

    
    
}
