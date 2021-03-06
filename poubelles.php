<?php 
 class MediaApiTest extends WebTestCase
{ 
    /** 
     * Create a client with a default Authorization header.
     *
     * @param string $username
     * @param string $password
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */

    protected function createAuthenticatedApiClient($username = 'test')
    {
        $client = static::createClient();

        /** @var JWTTokenManagerInterface $tokenManager */
        $tokenManager = static::$kernel->getContainer()->get('lexik_jwt_authentication.jwt_manager');

        /** @var UserRepository $userRepository */
        $userRepository = static::$kernel->getContainer()->get(UserRepository::class);

        $token = $tokenManager->create($userRepository->findOneBy(['username' => $username]));

        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $token));

        $client->setServerParameter('HTTP_ACCEPT', 'application/ld+json');
        $client->setServerParameter('CONTENT_TYPE', 'application/ld+json');

        return $client;
    }

    public function testUserIsAbleToCreateNewMediaForAvatar()
    {
        $username = 'test';

        $client = $this->createAuthenticatedApiClient($username);

        $avatar = new UploadedFile(
            __DIR__ . '/../../../src/DataFixtures/media/test.jpg',
            'test.jpg',
            'image/jpeg',
            null,
            true
        );

        $crawler = $client->request(
           'POST', // $method
             '/api/auth/v1/media', // $url
             array( // $parameters
                 'mediaType' => Media::MEDIA_TYPE_AVATAR
             ),
             array('mediaFile' => ['file' => $avatar]),  //$files
             array( // $server
                 'CONTENT_TYPE' => 'multipart/form-data',
             )
         );

         $this->assertSame(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
     }

    public function testNewPhotos() {
        $client = $this->createClient();
        $client->request(
            'POST', 
            '/submit', 
            array('name' => 'Fabien'), 
            array('photo' => __FILE__)
        );

        $this->assertEquals(1, count($client->getRequest()->files->all()));
    }
    if(is_array($data)|| is_object($data)) {
        foreach ($data as $key => $value) {
            $donne = 'set'.ucfirst($key);
            if (method_exists($user, $donne)) {
                if ($key=='profile') {
                    $profileID = $data['profile'];
                    $profile = $profilRepository->findOneBy(['id' => $profileID]);
                    $user->$donne($profile);
                } else {
                    $user->$donne($value);
                }
            }
        }
        dd($user);
    }
      //  public function testAddUser()
   //  {
   //     $client = $this->createAuthenticatedClient();
   //     $client->request(
   //         'POST', 'users',
   //         [],
   //         [],
   //         ['CONTENT_TYPE' => 'application/json'],
   //         '{
            
   //          "nom" : "momo",
   //          "prenom" : "diop",
   //          "username" : "KEARNER",
   //          "role" : "/api/admin/profils/2",
   //          "email" : "kane@gmail.com",
   //          "phone" : "222298900",
   //          "password" : "fffff99",
   //          "profil" : "/api/admin/profils/2" 
   //         }'
   //      );
   //     //dd($client->getResponse()->getStatusCode());
   //     $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
   //  }
    
   //  public function testAddEmptyProfiles()
   //  {
   //     $client = $this->createAuthenticatedClient();
   //     $client->request(
   //         'POST', 'users',
   //         [],
   //         [],
   //         ['CONTENT_TYPE' => 'application/json'],
   //         '{
   //         }'
   //      );
   //     // dd($client);
   //     $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
   //  }
     //  public function testUpdateUser()
   //  {
   //    $client = $this->createAuthenticatedClient();
   //    $client->request('post', 'users',
   //        [],
   //        [],
   //        ['CONTENT_TYPE' => 'application/json'],
   //        '{
   //           "archive":true
   //        }'
   //     );
   //    // dd($client);
   //     $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
   //  }
   protected $request;
   protected $serializer;
   protected $validator;
   protected $file;
   protected $manager;
   protected $encoder;
   protected $userripo;
   protected $profilripo;

  public function __construct(
    SerializerInterface $serializer,
    ValidatorInterface $validator,
    UserServices $file,
    EntityManagerInterface $manager,
    UserPasswordEncoderInterface $encoder,
    UserRepository $userripo,
    ProfileRepository $profilripo
  //   Request $request
    
  )
  {
      $this->serialize = $serializer;
      $this->validator = $validator;
      $this->file      = $file;
      $this->manager   = $manager;
      $this->encoder   = $encoder;
      $this->profilripo= $profilripo;
      $this->userripo  = $userripo;
      // $this->request   = $request;

  }

         //function validator
         public function validateUser($user,$serializer,$validator)
         {   
             // foreach($user as $key => $data){
             //     $noBlank[] = $validator->notBblank($data,$key);
             //     if (count($noBlank)){
             //         $errors = $this->serializer->serialize($noBlank, "json");
             //         return new JsonResponse($errors, Response::HTTP_BAD_REQUEST, [], true);
             //     }
             // }
             $user = $serializer->denormalize($user, "App\Entity\User");
            
             
             $errors = $this->validator->validate($user);
             if (count($errors)){
                 $errors = $this->serializer->serialize($errors, "json");
                 return new JsonResponse($errors, Response::HTTP_BAD_REQUEST, [], true);
             }
             return $user;
         }
     
    let fileManager = request.modules.VMFile;
    let mimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/x-icon', '  video/mpeg', 'text/html', 'video/x-msvideo', 'application/msword', 'application/pdf', 'application/vnd.ms-powerpoint', 'application/x-rar-compressed'];
  
    let maxFileSize = 4 * 1024 * 1024;
 }
 namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use App\Service\Securizer;
use App\Entity\User;

class SwitchUserVoter extends Voter {

    private $security;
    private $securizer;

    public function __construct(Security $security, Securizer $securizer) {
        $this->security = $security;
        $this->securizer = $securizer;
    }

    protected function supports($attribute, $subject) {
        return in_array($attribute, ['CAN_SWITCH_USER']) && $subject instanceof User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token) {
        $user = $token->getUser();
        //l'utilisateur doit être connecté et la cible doit être un utilisateur
        if (!$user instanceof User || !$subject instanceof User) {
            return false;
        }
        //on ne peux pas se connecter en tant que sois même, ça n'a aucun sens
        if($user->getId() == $subject->getId()){
            return false;
        }
        //l'utilisateur doit avoir le ROLE_ADMIN
        if (!$this->security->isGranted('ROLE_ADMIN')) {
            return false;
        }
        //Impossible si je ne suis pas SUPERADMIN et que le sujet l'est
        if (!$this->security->isGranted('ROLE_SUPERADMIN') && $this->securizer->isGranted($subject, 'ROLE_SUPERADMIN')) {
            return false;
        }
        //sinon c'est ok.
        return true;
    }

       /**
     * @Route(
     *      path="api/amdin/users/{id}",
     *      methods={"GET"}
     * )
     */
    public function getProfile(User $user)
    {
        return $this->json($user, Response::HTTP_OK);
    }

    // /**
    //  * @Route(
    //  *      path="api/amdin/users",
    //  *      methods={"GET"}
    //  * )
    //  */
    // public function getProfil(UserRepository $repo)
    // {
    //     $profil = $repo->findBy(['archive' => false]);

    //     return $this->json($profil, Response::HTTP_OK);
    // }
    protected $request;
    protected $serializer;
    protected $validator;
    protected $file;
    protected $manager;
    protected $encoder;

   public function __construct(
     SerializerInterface $serializer,
     ValidatorInterface $validator,
     UserServices $file,
     EntityManagerInterface $manager,
     UserPasswordEncoderInterface $encoder
   //   Request $request
     
   )
   {
       $this->serialize = $serializer;
       $this->validator = $validator;
       $this->file      = $file;
       $this->manager   = $manager;
       $this->encoder   = $encoder;
       // $this->request   = $request;

   }





   *  @ApiResource(
   *     attributes={
   *         "pagination_items_per_page"=7,
   *          "security"="is_granted('ROLE_ADMIN')",
   *          "security_message"="Acces refusé vous n'avez pas l'autorisation"
   *     },
   *     collectionOperations={
   *          "get"={
   *                "path"="/users",
   *                "get"={"security"="is_granted('ROLE_ADMIN')", "security_message"="Only admins can add books."}
   *              }, 
   *          "post"={
   *                "path"="/users",
   *                "post"={"security"="is_granted('ROLE_ADMIN')", "security_message"="Only admins can add books."}
   *              }
   *      },
   *     itemOperations={
   *         "GET"={
   *                "path"="/users/{id}"
   *            },
   *         "PUT"={
   *             "path"="/users/{id}"
   *          },
   *         "DELETE"={
   *             "path"="/users/{id}"
   *          },
   *  }
   * )

}<?php

namespace App\DataPersister\UserDataPersister;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

final class UserDataPersister implements DataPersisterInterface
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager,DataPersisterInterface $decorated)
    {
        $this->entityManager = $entityManager;
        $this->decorated = $decorated;
    }

    public function supports($data): bool
    {
        return $data instanceof User;
    }

    public function persist($data)
    {   
        return $data;
    }

    public function remove($data)
    {
        $data->setArchive(true);
        $this->entityManager->flush();
        return $data;
    }
    public function remove($data)
    {
        $data->setArchive(true);
        $users = $data->getUsers();
        foreach($users as $u)
            $u->setArchive(true);

        $this->entityManager->flush();
        return $data;
    }
    
}