<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Promo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PromoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    { 
        $faker = Factory::create('fr_FR');
        $promo = (new Promo());
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
            ;

        $manager->persist($promo);
        $manager->flush();
    }

    
}

