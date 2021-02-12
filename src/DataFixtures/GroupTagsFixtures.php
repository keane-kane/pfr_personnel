<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\GroupTags;
use App\DataFixtures\TagsFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GroupTagsFixtures extends Fixture implements DependentFixtureInterface
{  

    public function load(ObjectManager $manager)
    {

        $data = ["Devellopeur","Design","Reference"];
        $faker = Factory::create('fr_FR');
        foreach($data as $k=>$value)
        {
            $gtags = new GroupTags();
            $gtags->setLibelle($value)
                 ->setArchive(false)
                 ->setDescription($faker->text)
                 ->addTag($this->getReference("tags".$k))
                 ->addTag($this->getReference("tags".($k+1)))
                 ->addTag($this->getReference("tags".($k+2)))
            ;
            $manager->persist($gtags);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return array (
            TagsFixtures::class,
        );
    }
}
