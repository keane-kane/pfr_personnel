<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\CompetenceValides;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CompetenceValidesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $niv= ["Valider","A refaire","Non valider"];
        $faker = Factory::create('fr_FR');
        $compvalid = new CompetenceValides();
        $compvalid->setNiveau1($faker->randomElement($niv))
                  ->setNiveau2($faker->randomElement($niv))
                  ->setNiveau3($faker->randomElement($niv))
                  ->setApprenant($this->getReference('apprenant0'))
                  ->setPromo($this->getReference('promo'))
        ;
        $manager->persist($compvalid);
        $this->addReference('compvalid', $compvalid);

        $manager->flush();
    }
    public function getDependencies()
    {   
        return [
            UserFixtures::class,
            PromoFixtures::class
        ];
    }
}
