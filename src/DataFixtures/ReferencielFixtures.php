<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Referentiel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\GroupCompetenceFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ReferencielFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $data = ["Referenciel Digital","Referenciel Dev web", "Referenciel Data Scientics"];
        $faker = Factory::create('fr_FR');
       foreach($data as $k=>$value){
            $ref = new Referentiel();
            $ref->setLibelle($value)
                ->setPresentation($faker->presentation)
                ->setProgrammes($faker->text)
                ->setCriteresEvaluation($faker->text)
                ->setCriteresAdmission($faker->title)
                ->setArchive(false)
                ->addGroupeCompetence($this->getReference('gcompe'.$k));
            $manager->persist($ref);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
           GroupCompetenceFixtures::class
        );
    }
}
