<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;


class Statistics{

    public function __construct(ObjectManager $manager){

        $this->manager = $manager;

    }

    public function getStatistics(){

        $intro = $this->getIntroCount();
        $news = $this->getNewsCount();
        $contact = $this->getContactCount();
        $partner = $this->getPartnerCount();
        $team = $this->getTeamCount();
        $prestations = $this->getPrestationsCount();
        

        return compact('intro','news','contact','partner','team','prestations');

    }

    public function getIntroCount(){

        return $this->manager->createQuery('SELECT COUNT(i) FROM App\Entity\Intro i')->getSingleScalarResult();

    }

    public function getNewsCount(){

        return $this->manager->createQuery('SELECT COUNT(n) FROM App\Entity\News n')->getSingleScalarResult();

    }

    public function getContactCount(){

        return $this->manager->createQuery('SELECT COUNT(c) FROM App\Entity\Contact c')->getSingleScalarResult();

    }

    public function getPartnerCount(){

        return $this->manager->createQuery('SELECT COUNT(p) FROM App\Entity\Partner p')->getSingleScalarResult();

    }

    public function getTeamCount(){

        return $this->manager->createQuery('SELECT COUNT(t) FROM App\Entity\Team t')->getSingleScalarResult();

    }

    public function getPrestationsCount(){

        return $this->manager->createQuery('SELECT COUNT(e) FROM App\Entity\Prestations e')->getSingleScalarResult();

    }

    

    
}