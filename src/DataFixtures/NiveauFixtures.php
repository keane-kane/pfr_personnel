<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Niveau;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class NiveauFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      $data = ["Niveau 1", "Niveau 2", "Niveau 3"];
      $critere= ["Assez bien","Bien","Mediocre","Tres Bien"];
        $faker = Factory::create('fr_FR');
        foreach($data as $k=>$value){
            
            $niv =( new Niveau());
            $niv->setLibelle($value)
                ->setCriteresEvaluation($critere[$k])
                ->setArchive(false)
                ->setGroupeAction($faker->text)
            ;
           $manager->persist($niv);
           $this->addReference("niv".$k, $niv);
        }
     
        $manager->flush();
    }
}
