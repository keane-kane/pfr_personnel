<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfileFixtures extends Fixture
{
   

    public const ADMIN_USER_REFERENCE = 'ADMIN';
    public const FORMATEUR_USER_REFERENCE = 'FORMATEUR';
    public const APPRENANT_USER_REFERENCE = 'APPRENANT';
    public const CM_USER_REFERENCE = 'CM';
    

    public function load(ObjectManager $manager)
    {
            
            $admin = new Profile();
            $admin->setLibelle(self::ADMIN_USER_REFERENCE);
            $manager->persist($admin);
            
             
            $apprenant = new Profile();
            $apprenant->setLibelle(self::APPRENANT_USER_REFERENCE);
            $manager->persist($apprenant);
            
            $formateur = new Profile();
            $formateur->setLibelle(self::FORMATEUR_USER_REFERENCE);
            $manager->persist($formateur);

            $cm = new Profile();
            $cm->setLibelle(self::CM_USER_REFERENCE);
            $manager->persist($cm);
    
            
            $this->addReference(self::ADMIN_USER_REFERENCE, $admin);    
            $this->addReference(self::FORMATEUR_USER_REFERENCE, $formateur);
            $this->addReference(self::APPRENANT_USER_REFERENCE, $apprenant); 
            $this->addReference(self::CM_USER_REFERENCE, $cm);
            $manager->flush();
    }
}