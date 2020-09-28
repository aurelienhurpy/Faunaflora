<?php

namespace App\Controller;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminInfosController extends AbstractController
{
    /**
     * @Route("/admin/info\{page<\d+>?1}", name="admin_infos")
     */
    public function index(ObjectManager $manager)
    {

        return $this->render('admin/infos/infos.html.twig');
    }
}
