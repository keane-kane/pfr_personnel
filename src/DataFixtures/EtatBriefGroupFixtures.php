<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\EtatBriefGroup;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EtatBriefGroupFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');
        $etatbriefgp = (new EtatBriefGroup())
                    ->setStatut($faker->randomElement(["valider","non valide","a refaire"]))
                    ->setEtatbriefs($this->getReference('brief0'))
                    ->setEtatgroup($this->getReference('groupe0'))
        ;

        $manager->persist($etatbriefgp);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            BriefFixtures::class,
            GroupeFixtures::class,
        ];
    }
}
