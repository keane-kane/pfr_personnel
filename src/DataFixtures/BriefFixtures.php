<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Brief;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BriefFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($k=0 ; $k< 5 ; ++$k)
        {           
            $brief = new Brief();
            $brief->setLangue($faker->randomElement(array("Français","Anglais","Arabe","Espagnol")))
              ->setNom($faker->randomElement(array("Veille MVC","Veille sur OMR","Veille sur les Relations entre classe")))
              ->setDescription($faker->text)
              ->setContexte($faker->text)
              ->setModaliteEvaluation($faker->text)
              ->setCritereEvaluation($faker->text)
              ->setModalitePedagogigue($faker->text)
              ->setAvatar($faker->image())
              ->setArchive(false)
              ->setEtat($faker->randomElement(array("Valide","Brouillon")))
              ->setCreatedAt(new\ DateTime())
              ->addTag($this->getReference('tag'.$k))
              ->addNiveau($this->getReference("niv".$k))
              ->setFormateur($this->getReference('forma'.$k))
              ;
            
            $manager->persist($brief);
        }
        $manager->flush();
    }
}
