<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Brief;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BriefFixtures extends Fixture implements DependentFixtureInterface
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
              ->setEtat($faker->randomElement(array("Valide","Brouillon","Assigné")))
              ->setCreatedAt(new \DateTime())
              ->addTag($this->getReference('tags'.$k))
              ->addNiveau($this->getReference($faker->randomElement(["niv0","niv2","niv1"])))
              ->setFormateur($this->getReference('forma'.$k))
              ;
            
            $manager->persist($brief);
            $this->addReference('brief'.$k,$brief);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return array (
            TagsFixtures::class,
            UserFixtures::class,
            NiveauFixtures::class
        );
    }
}
