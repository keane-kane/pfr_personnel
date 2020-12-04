<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\CompetenceValides;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompetenceValidesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $niv= ["Valider","A refaire","Non valider"];
        $faker = Factory::create('fr_FR');
        $compvalid = new CompetenceValides();
        $compvalid->setNiveau1("Niveau 1".$faker->randomElement($niv))
                  ->setNiveau2("Niveau 2".$faker->randomElement($niv))
                  ->setNiveau2("Niveau 3".$faker->randomElement($niv))
        ;

        $this->addReference('compvalid', $niv);
        $manager->persist($compvalid);

        $manager->flush();
    }
}
