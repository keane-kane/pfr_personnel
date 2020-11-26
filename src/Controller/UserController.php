<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProfileRepository;
use App\services\UserServices;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{ 
   

    public const USER = "App\Entity\User";
    
    /**
     * @Route(
     *      path="api/users/{id}",
     *      methods={"GET"}
     * )
     */
    public function getProfile(User $user)
    {
        return $this->json($user, Response::HTTP_OK);
    }

    // /**
    //  * @Route(
    //  *      path="api/users",
    //  *      methods={"GET"}
    //  * )
    //  */
    // public function getProfil(UserRepository $repo)
    // {
    //     $profil = $repo->findBy(['archive' => false]);

    //     return $this->json($profil, Response::HTTP_OK);
    // }

       /**
     * @Route(
     *     path="/api/users",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\UserController::addUser",
     *          "__api_resource_class"=User::class,
     *          "__api_collection_operation_name"="add_user"
     *     }
     * )
     */
    public function addUser(
      Request $request,
      SerializerInterface $serializer,
      ValidatorInterface $validator,
      UserServices $file,
      EntityManagerInterface $manager,
      UserPasswordEncoderInterface $encoder
      )
      {   
        
          $user = $file->newUser($request, $serializer,$validator,self::USER,$manager,$encoder);
         
            return $this->json($user);
      }

     /**
     * @Route(
     *     path="/api/users/{id}",
     *     methods={"PUT"},
     *     defaults={
     *          "__controller"="App\Controller\UserController::addUser",
     *          "__api_resource_class"=User::class,
     *          "__api_collection_operation_name"="add_user"
     *     }
     * )
     */
    public function updateUser(
      Request $request,
      UserRepository $userripo,
      UserServices $file,
      EntityManagerInterface $manager,
      ProfileRepository $profilripo,
      UserPasswordEncoderInterface $encoder
      )
    {   
         $user = $file->updateUser($request, $userripo,$profilripo,$manager,$encoder);
        //  dd($user);
        return $this->json($user, Response::HTTP_CREATED);
    }
}
