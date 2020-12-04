<?php

namespace App\Controller;

use App\Entity\Cm;
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

class CmController extends AbstractController
{ 
   
    public const CM = "App\Entity\Cm";

    /**
     * @Route(
     *     path="/api/admin/users/cms",
     *     methods={"POST"},
     
     * )
     */
    public function addCm(
      Request $request,
      SerializerInterface $serializer,
      ValidatorInterface $validator,
      UserServices $file,
      EntityManagerInterface $manager,
      UserPasswordEncoderInterface $encoder
      )
      {   
        
          $user = $file->newUser($request, $serializer,$validator,self::CM,$manager,$encoder);
         
            return $this->json($user);
      }

     /**
     * @Route(
     *     path="/api/admin/users/cms/{id}",
     *     methods={"PUT"},
  
     * )
     */
    public function updateCm(
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

