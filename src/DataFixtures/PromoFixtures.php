<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Promo;
use App\Entity\Groupe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PromoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    { 
        $faker = Factory::create('fr_FR');
        $promo = new Promo();
        $groupe = (new Groupe())
                ->setNom("Groupe Principal")
                ->setDateCreation(new \DateTime());
                for ($i=0; $i <5 ; $i++) {
                
                    $groupe->addComposer($this->getReference('apprenant'.$i));
                    $promo->addGroupe($this->getReference('groupe'.$i));
                }
        ;
        
        $promo->setArchive(0)
              ->setLieu("Dakar")
              ->setAvatar($faker->imageUrl())
              ->setFabrique("ODC")
              ->setDescription($faker->text())
              ->setDateCloture(new \DateTime())
              ->setDateDebut(new \DateTime())
              ->setTitre($faker->title())
              ->setLangue($faker->languageCode)
              ->setReferenceAgate($faker->isbn10)
              ->addGroupe($groupe)
              
            ;
        $this->addReference('promo',$promo);
        $manager->persist($promo);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GroupeFixtures::class,
        ];
    }
}

