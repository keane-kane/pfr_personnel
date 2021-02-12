<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Repository\ProfileRepository;
use App\Services\UserServices;
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

class AdminController extends AbstractController
{ 
   
    public const ADMIN = "App\Entity\Admin";
    
    /**
     * @Route(
     *     path="api/admin/users",
     *     methods={"POST"},
     * )
     */
    public function addAdmin(
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UserServices $file,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder
    )
    {   
        $user = $file->newUser($request, $serializer,$validator,self::ADMIN,$manager,$encoder);
        return $this->json($user);
    }

     /**
     * @Route(
     *     path="api/admin/users/{id}",
     *     methods={"PUT"},
     *     defaults={
     *          "__controller"="App\Controller\AdminController::addAdmin",
     *          "__api_resource_class"=Admin::class,
     *          "__api_collection_operation_name"="add_Admin"
     *     }
     * )
     */
    public function updateAdmin(
        Request $request,
        UserRepository $userRepository,
        UserServices $file,
        EntityManagerInterface $manager,
        ProfileRepository $profilripo,
        UserPasswordEncoderInterface $encoder
    )
    {
         $user = $file->updateUser($request, $userRepository,$profilripo,$manager,$encoder);
        //  dd($user);
        return $this->json($user, Response::HTTP_CREATED);
    }
}

