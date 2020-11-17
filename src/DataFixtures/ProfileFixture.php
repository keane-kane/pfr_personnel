<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfileFixture extends Fixture
{
   

    // ...
    public function load(ObjectManager $manager)
    {
        $profile = new Profile();
        $profils = ["ADMIN", "FORMATEUR", "APPRENANT", "CM"];
        foreach ($profils as $key => $libelle) {
            $profile->setLibelle($libelle);
            $manager->persist($profile);
            $manager->flush();
            $this->addReference('profile'.$key, $profile);
      
        }
    }
}