<?php


namespace App\Tests;


use App\Entity\User;
use App\Entity\Formateur;
use PHPUnit\Framework\TestCase;
use App\DataFixtures\ProfileFixtures;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class UserEntityTest extends KernelTestCase
{
    public function getUser():Formateur
    {
        return (new Formateur())
                ->setEmail("aziz@gmail.com")
                ->setNom("kane")
                ->setUsername(ProfileFixtures::FORMATEUR_USER_REFERENCE)
                ->setPrenom("abdou")
                ->setPhone("77898768")
                ->setArchive("false")
                ->setPassword("admin")
                ;
    }
    public function assertHasErrors(Formateur $user, int $number=0)
    {
        self::bootkernel();
        $error = self::$container->get('validator')->validate($user);
        $this->assertCount($number, $error);
    }
   
    public function testvalideUser()
    {
        $this->assertHasErrors($this->getUser(), 0);
    }
    
    public function testInvalideUser()
    {
        $this->assertHasErrors($this->getUser()->setPassword(""), 1);
    }
   
}