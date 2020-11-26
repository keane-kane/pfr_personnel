<?php
// tests/UserControllerTest.php
namespace App\Tests;

use App\Tests\LoginTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class UserControllerTest extends WebTestCase
{
   
    use LoginTrait;
    
    //=====collectionOperations======

   public function testGetUsers()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', 'users');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }


    public function ttestAddUser() 
    {
        $expectedData = $this->listData($this->tab(),Response::HTTP_CREATED);  
        
    }



     //====itemOperations======
    //error demain internet
    public function testGetOneUser()
    {
       $client = $this->createAuthenticatedClient();
       $client->request('GET', 'users/4');
       $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
    public function testUpdateUser() 
    {
        $expectedData = $this->listData($this->tab(), Response::HTTP_OK);  
     
    }
  

    
    public function testDeleteUser()
    {
       $client = $this->createAuthenticatedClient();
       $client->request('DELETE', 'users/3');
       $this->assertTrue($client->getResponse()->isSuccessful());
    }
    

}

