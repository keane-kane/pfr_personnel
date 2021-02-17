<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Repository\ProfileRepository;
use App\Services\UserServices;
use App\Repository\AdminRepository;
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
     *      path="/api/admin/users",
     *      methods={"GET"}
     * )
     */
    public function all(AdminRepository $repo)
    {
        $cm = $repo->findByArchive("0");
        return $this->json($cm, Response::HTTP_OK);
    }
    
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
     *     methods={"PUT"}
     * )
     */
    public function updateAdmin(
        Request $request,
        AdminRepository $adminRepository,
        UserServices $file,
        EntityManagerInterface $manager,
        ProfileRepository $profilripo,
        UserPasswordEncoderInterface $encoder
    )
    {
         $user = $file->updateUser($request, $adminRepository,$profilripo,$manager,$encoder);
        //  dd($user);
        return $this->json($user, Response::HTTP_CREATED);
    }
}

