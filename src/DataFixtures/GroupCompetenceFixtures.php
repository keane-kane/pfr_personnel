<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\GroupCompetence;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupCompetenceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    { 
        $data = ["developpement web","Diesigner","Data Scientics","Integrateur"];
        $faker = Factory::create('fr_FR');
        $compe = new GroupCompetence();
        foreach($data as $value){

        $compe->setLebelle($value);
        $compe->setDescriptif($faker->text);
        $compe->setArchive(false);
        $manager->persist($compe);
    }

        $manager->flush();
    }
}
