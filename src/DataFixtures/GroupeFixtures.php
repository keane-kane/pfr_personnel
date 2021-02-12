<?php

namespace App\DataFixtures;

use App\Entity\Groupe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class GroupeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker =Factory::create('fr_FR');
        
        for ($i=0; $i < 5; $i++)   {
            $groupe = (new Groupe())
                    ->setNom("Groupe".($i+1))
                    ->setDateCreation(new \DateTime())
                    ->addFormateur($this->getReference('forma'.$i))
                    ->addComposer($this->getReference('apprenant'.$i))
                    ;
            $manager->persist($groupe);
            $this->addReference('groupe'.$i,$groupe);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
