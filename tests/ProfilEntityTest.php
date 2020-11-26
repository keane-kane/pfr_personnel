<?php


namespace App\Tests;


use App\Entity\Profile;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ProfilEntityTest extends KernelTestCase
{
    public function getProfile():Profile
    {
        return (new Profile())
               ->setLibelle("apprenant")
               ->setArchive(false)
               ;       
    }
    public function assertHasErrors(Profile $profil, int $number=0)
    {
        self::bootkernel();
        $error = self::$container->get('validator')->validate($profil);
        $this->assertCount($number, $error);
    }
   
    public function testvalideProfile()
    {
        $this->assertHasErrors($this->getProfile(), 0);
    }
    
    public function testInvalideProfile()
    {
        $this->assertHasErrors($this->getProfile()->setLibelle(''), 1);
    }
   
}