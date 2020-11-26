<?php
// tests/ProfilControllerTest.php
namespace App\Tests;

use App\Tests\LoginTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ProfilControllerTest extends WebTestCase
{
    use LoginTrait;
  
    //=====collectionOperations======
   public function testGetProfiles()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', 'admin/profils');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testCreateProfiles()
    {
       $client = $this->createAuthenticatedClient();
       $client->request(
           'POST', 'admin/profils',
           [],
           [],
           ['CONTENT_TYPE' => 'application/json'],
           '{
              "libellle":"commity manager",
              "archive":true
                
           }'
        );
       //dd($client->getResponse()->getStatusCode());
       $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
    
    public function testCreateEmptyProfiles()
    {
       $client = $this->createAuthenticatedClient();
       $client->request(
           'POST', 'admin/profils',
           [],
           [],
           ['CONTENT_TYPE' => 'application/json'],
           '{
              "libelle":""
            }'
        );
       // dd($client);
       $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
  
   
  
    

     //====itemOperations======
    //error demain internet
   public function testGetOneProfil()
    {
       $client = $this->createAuthenticatedClient();
       $client->request('GET', 'admin/profils/4' );

       $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testUpdateProfile()
    {
      $client = $this->createAuthenticatedClient();
      $client->request(
          'DELETE', 'admin/profils/4',
          [],
          [],
          ['CONTENT_TYPE' => 'application/json'],
          '{
             "archive":true
          }'
       );
      // dd($client);
       $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

   //get_user_in_profil
    public function testGetUserInProfiles()
    {
       $client = $this->createAuthenticatedClient();
       $client->request('GET', 'admin/profils/4/users');
       $this->assertTrue($client->getResponse()->isSuccessful());
    }
    

}

