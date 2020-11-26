<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Competence;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompetenceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    { 
        $data = ["java","javascript","php","angularJs"];
        $faker = Factory::create('fr_FR');
        $compe = new Competence();
        foreach($data as $value){

        $compe->setLibelle($value);
        $compe->setDescriptif($faker->text);
        $compe->setArchive(false);
        $manager->persist($compe);
    }

        $manager->flush();
    }
}
