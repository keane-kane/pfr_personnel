<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tags;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagsFixtures extends Fixture 
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
                 ->setDescription($faker->text)

            ;  
            $this->addReference('tags'.$k, $tags);
            $manager->persist($tags);
        }
        $manager->flush();
    }
  
}
