<?php
namespace App\DataFixtures;

use App\Entity\Cm;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
       
        for($i = 0; $i < 5; ++$i){
            $user = new Admin();
            $user->setEmail($faker->email);
            $user->setNom($faker->lastName);

            $user->setUsername(ProfileFixtures::ADMIN_USER_REFERENCE.$i);
            $user->setProfil($this->getReference(ProfileFixtures::ADMIN_USER_REFERENCE));
            $user->setPrenom($faker->firstName);
            $user->setPhone($faker->phoneNumber);
            $user->setAvatar($faker->imageUrl());
            $user->setArchive(false);

            $password = $this->encoder->encodePassword($user, ProfileFixtures::ADMIN_USER_REFERENCE);
            $user->setPassword($password);


            $manager->persist($user);
            $manager->flush();
              
        }

        for($i = 0; $i < 5; ++$i){
            $user = new Formateur();
            $user->setEmail($faker->email);
            $user->setNom($faker->lastName);
            $user->setAvatar($faker->imageUrl());
            $user->setUsername(ProfileFixtures::FORMATEUR_USER_REFERENCE.$i);
            $user->setProfil($this->getReference(ProfileFixtures::FORMATEUR_USER_REFERENCE));
            $user->setPrenom($faker->firstName);
            $user->setPhone($faker->phoneNumber);
            $user->setArchive(false);

            $password = $this->encoder->encodePassword($user, ProfileFixtures::FORMATEUR_USER_REFERENCE);
            $user->setPassword($password);
            $manager->persist($user);
            $this->addReference("forma".$i,$user);
              
        }

        for($i = 0; $i < 5; ++$i){
            $user = new Apprenant();
            $user->setEmail($faker->email);
            $user->setNom($faker->lastName);
            $user->setAvatar($faker->imageUrl());
            $user->setUsername(ProfileFixtures::APPRENANT_USER_REFERENCE.$i);
            $user->setProfil($this->getReference(ProfileFixtures::APPRENANT_USER_REFERENCE));
            $user->setPrenom($faker->firstName);
            $user->setPhone($faker->phoneNumber);
            $user->setArchive(false);

            $password = $this->encoder->encodePassword($user, ProfileFixtures::APPRENANT_USER_REFERENCE);
            $user->setPassword($password);

            $manager->persist($user);
            $this->addReference("apprenant".$i,$user);
            
              
        }

        for($i = 0; $i < 5; ++$i){
            $user = new Cm();
            $user->setEmail($faker->email);
            $user->setNom($faker->lastName);
            $user->setAvatar($faker->imageUrl());
            $user->setUsername(ProfileFixtures::CM_USER_REFERENCE.$i);
            $user->setProfil($this->getReference(ProfileFixtures::CM_USER_REFERENCE));
            $user->setPrenom($faker->firstName);
            $user->setPhone($faker->phoneNumber);
            $user->setArchive(false);

            $password = $this->encoder->encodePassword($user, ProfileFixtures::CM_USER_REFERENCE);
            $user->setPassword($password);

            $manager->persist($user);
              
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            ProfileFixtures::class,
        );
    }
    
}