<?php

namespace App\Controller;

use App\Entity\Apprenant;
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
    public function addApprenant(Request $request)
    {   
        $user = $this->file->newUser($request, $this->serializer,$this->validator,self::APPRENANT,$this->manager,$this->encoder);
        return $this->json($user);
    }

     /**
     * @Route(
     *     path="/api/admin/users/apprenants/{id}",
     *     methods={"PUT"},
     * 
     * )
     */
    public function updateApprenant()
    {
        $user = $this->file->updateUser($this->request, $this->userripo,$this->profilripo,$this->manager,$this->encoder);
       //  dd($user);
       return $this->json($user, Response::HTTP_CREATED);
    }
}

