<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AnnonceType;
use App\Entity\PasswordUpdate;
use App\Form\AdminAccountType;
use App\Form\PasswordUpdateType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminAccountController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_account_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('admin/account/login.html.twig', [

            'hasError'=>$error !==null,
            'username'=>$username
            
        ]);
    }

    /**
     * Permet la deconnexion de la partie admin
     * @Route("/admin/logout",name="admin_account_logout")
     * @return void
     */
    public function logout(){

    }

    /**
     * Modification du profil admin
     *
     * @Route("/admin/account/profile",name="admin_account_profile")
     * @return Response
     */
    public function profile(Request $request,ObjectManager $manager){

        $user = $this->getUser();
        
        $form=$this->createForm(AdminAccountType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($user);

            $manager->flush();

            $this->addFlash("success","Les informations de votre profil ont bien été mises à jour");

        }

        return $this->render('admin/account/profile.html.twig',['form'=>$form->createView()]);

    }

        /**
         * Permet la modification du mot de passe
         * @Route("/admin/account/password-update",name="admin_account_password")
         *
         * @return Response
         */
    public function updatePassword(Request $request,UserPasswordEncoderInterface $encoder,ObjectManager $manager){

        $passwordUpdate = new PasswordUpdate();
        $user=$this->getUser();

        $form=$this->createForm(PasswordUpdateType::class,$passwordUpdate);

        $form->handlerequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // mot de passe actuel n'est pas le bon

            if(!password_verify($passwordUpdate->getOldPassword(),$user->getHash())){

                // message d'erreur

                //$this->addFlash("warning","Mot de passe actuel incorrect");

                $form->get('oldPassword')->addError(new FormError("Mot de passe actuel incorrect"));

                }else{

                    // on recupere le nouveau mot de passe 

                    $newPassword = $passwordUpdate->getNewPassword();
        
                    // on crypte le nouveau mot de passe

                    $hash = $encoder->encodePassword($user,$newPassword);
        
                    // on modifie le nouveau mot de passe dans le setter

                    $user->setHash($hash);
        
                    // on enregistre

                    $manager->persist($user);
                    $manager->flush();
        
                    // on ajoute un message

                    $this->addFlash("success","Votre nouveau mot de passe a bien été enregistré");
        
                    // on redirige

                    return $this->redirectToRoute('admin_account_home');
                }

        }

        return $this->render('admin/account/password.html.twig',['form'=>$form->createView()]);

    }

    /**
     * Permet d'afficher la page mon compte
     * @Route("/admin/account",name="admin_account_home")
     * @return Response
     */
    public function myAccount(){

        return $this->render("admin/account/index.html.twig",['user'=>$this->getUser()]);

    }

}
