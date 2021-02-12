<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Referenciel;
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
            $ref = new Referenciel();
            $ref->setLibelle($value)
                ->setPresentation($faker->paragraph())
                ->setProgrammes($faker->text)
                ->setCriteresEvaluation($faker->text)
                ->setCriteresAdmission($faker->title)
                ->setCompetenceViser($faker->randomElement($data))
                ->setArchive(false)
                ->addGroupeCompetence($this->getReference('gcompe'.$k))
                ->addPromo($this->getReference('promo'));
            $manager->persist($ref);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
           GroupCompetenceFixtures::class,
           PromoFixtures::class,
        );
    }
}
