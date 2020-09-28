<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){

        $this->encoder = $encoder;

    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        // gestion des roles
        
        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        // creation d'n utilisateur special avec un role admin

        $adminUser = new User();
        $adminUser->setFirstName('admin')
                    ->setLastName('admin')
                    ->setEmail('admin@admin.com')
                    ->setHash($this->encoder->encodePassword($adminUser,'password'))
                    ->addUserRole($adminRole)
                    ;

        $manager->persist($adminUser);
        
        $users = [];

        for ($i=1; $i<3; $i++){

            $user = new User();
            $hash = $this->encoder->encodePassword($user,'password');
            
           
            $user ->setFirstname($faker->firstname)
                    ->setLastname($faker->lastname)
                    ->setEmail($faker->email)
                    ->setHash($hash)
                    ;
                
                $manager->persist($user);
                $users[]=$user;

        }

        $manager->flush();

    }
}
