<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tags;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TagsFixtures extends Fixture implements DependentFixtureInterface
{  

    public function load(ObjectManager $manager)
    {

        $data = ["html","css","javascript","Python","Java","C++","photoshop","Mysql","NoSql",""];
        $faker = Factory::create('fr_FR');
        foreach($data as $k=>$value)
        {
            $tags = new Tags();
            $tags->setLibelle($value)
                 ->setArchive(false)
                 ->setDescription($faker->description)

            ;
            $manager->persist($tags);
            $this->addReference('tag'.$k, $tags);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return array (
            GroupTagsFixtures::class,
        );
    }
}
