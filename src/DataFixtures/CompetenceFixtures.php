<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Niveau;
use App\Entity\Competence;
use App\DataFixtures\NiveauFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CompetenceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    { 
        $data = ["java","javascript","php","angularJs"];
        $faker = Factory::create('fr_FR');
        
        foreach($data as $k=>$value){

            $compe = new Competence();
            $compe->setLibelle($value);
            $compe->setDescriptif($faker->text);
            $compe->setArchive(false);
            $compe->addNiveau($this->getReference("niv0"));
            $compe->addNiveau($this->getReference('niv1'));
            $compe->addNiveau($this->getReference('niv2'));
            $manager->persist($compe);

            $this->addReference('compe'.$k, $compe);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            NiveauFixtures::class,
        );
    }
}
