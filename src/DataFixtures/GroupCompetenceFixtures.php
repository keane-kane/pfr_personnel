<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\GroupCompetence;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\CompetenceFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GroupCompetenceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    { 
        $data = ["developpement web","Diesigner","Data Scientics","Integrateur"];

        $faker = Factory::create('fr_FR');
        foreach($data as $k=>$value){
             
            $gcompe = new GroupCompetence();
            $gcompe->setLibelle($value);
            $gcompe->setDescriptif($faker->text);
            $gcompe->setArchive(false);
            $gcompe->addCompetence($this->getReference('compe'.$k));
            $manager->persist($gcompe);
            $this->addReference('gcompe'.$k, $gcompe);
    
         }

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
           CompetenceFixtures::class
        );
    }
}
