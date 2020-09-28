<?php

namespace App\Controller;

use App\Service\Statistics;
use App\Repository\ContactRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(ObjectManager $manager,Statistics $statsService, ContactRepository $contact)
    {

        $stats = $statsService->getStatistics();
        $contacts = $contact->findBy(['isRead'=>false]);

        return $this->render('admin/dashboard/index.html.twig', [
            'stats'=>$stats,
            'contacts'=>count($contacts)
        ]);
    }
}
