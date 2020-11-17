<?php

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        
        $user = new User();
        $user->setEmail($faker->email);
        $user->setUsername(strtolower($libelle) . $i);
        $user->setNom($faker->lastName);
        $user->setPrenom($faker->firstName);

        //Génération des Users
        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPlainPassword('admin');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();

        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference(self::ADMIN_USER_REFERENCE, $userAdmin);
    }
}