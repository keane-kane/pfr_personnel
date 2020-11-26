<?php

namespace App\Tests;

use App\Entity\Profile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait LoginTrait

{
  
    
    protected function createAuthenticatedClient(): KernelBrowser
    {
        $client = static::createClient();
      
        $client->request(
           'POST',
           '/api/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                "username":"ADMIN1",
                "password":"ADMIN"
            }'
        );
        $data = json_decode($client->getResponse()->getContent(), true);
        //dd($data);
        $client->setServerParameter('HTTP_AUTHORIZATION', \sprintf('Bearer %s', $data['token']));
        $client->setServerParameter('CONTENT_TYPE', 'application/ld+json');

        return $client;
    }
     
    public function tab()
    {
        $data = array( 
            "nom" => "momo",
            "prenom" => "diop",
            "username" => "KErrrR",
            "role" => "/api/admin/profils/2",
            "email" => "kane@gmail.com",
            "phone" => "222298900",
            "password" => "fffff99",
            "profil" => "/api/admin/profils/2",
            
        );
        return $data;
    }

    private function listData($data ,$code)
    {
        $client = $this->createAuthenticatedClient();
        $avatar = new UploadedFile(__DIR__ . '/Images/test.png','test.png',
        'image/png',
        null,
        true
        );
        $avatar = fopen($avatar->getRealPath(), "rb");
        $data["avatar"] = $avatar;
          $server = array('HTTP_CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json','CONTENT_TYPE' => 'multipart/form-data');
          $crawler = $client->request('POST', 'users',
            $data,
            array('mediaFile' => ['avatar' => $avatar]),
            array('CONTENT_TYPE' => 'multipart/form-data',
          ));
        // $response = $client->getResponse();
        // dd($response);
        $this->assertEquals($code, $client->getResponse()->getStatusCode());
        // $expectedData = json_decode($response->getContent(), true);
       
    }

//===========================================================================


}