<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Repository\ProfileRepository;
use App\Services\UserServices;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApprenantController extends AbstractController
{ 
   
    public const APPRENANT = "App\Entity\Apprenant";
    

    

    /**
     * @Route(
     *     path="api/admin/users/apprenants",
     *     methods={"POST"},
     *  
     * )
     */
    public function addApprenant(
      Request $request,
      SerializerInterface $serializer,
      ValidatorInterface $validator,
      UserServices $file,
      EntityManagerInterface $manager,
      UserPasswordEncoderInterface $encoder
    
    )
    {   
        $user = $file->newUser($request, $serializer,$validator,self::APPRENANT,$manager,$encoder);
        return $this->json($user);
    }

     /**
     * @Route(
     *     path="/api/admin/users/apprenants/{id}",
     *     methods={"PUT"},
     * 
     * )
     */
    public function updateApprenant(
        Request $request,
        ApprenantRepository $apprenantRepository,
        UserServices $file,
        EntityManagerInterface $manager,
        ProfileRepository $profilripo,
        UserPasswordEncoderInterface $encoder
    )
    {
        $user = $file->updateUser($request, $apprenantRepository,$profilripo,$manager,$encoder);
       //  dd($user);
       return $this->json($user, Response::HTTP_CREATED);
    }
}

