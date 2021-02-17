<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Repository\ProfileRepository;
use App\Services\UserServices;
use App\Repository\FormateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FormateurController extends AbstractController
{ 
   
    public const FORMATEUR = "App\Entity\Formateur";
    

     /**
     * @Route(
     *      path="/api/admin/users/formateurs",
     *      methods={"GET"}
     * )
     */
    public function all(FormateurRepository $repo)
    {
        $formateur = $repo->findByArchive("0");
        return $this->json($formateur, Response::HTTP_OK);
    }
    /**
     * @Route(
     *     path="api/admin/formateurs",
     *     methods={"POST"},
     * )
     */
    public function addFormateur(
      Request $request,
      SerializerInterface $serializer,
      ValidatorInterface $validator,
      UserServices $file,
      EntityManagerInterface $manager,
      UserPasswordEncoderInterface $encoder
      )
      {   
        
          $user = $file->newUser($request, $serializer,$validator,self::FORMATEUR,$manager,$encoder);
         
            return $this->json($user);
      }

     /**
     * @Route(
     *     path="api/admin/formateurs/{id}",
     *     methods={"PUT"},
     * )
     */
    public function updateFormateur(
      Request $request,
      FormateurRepository $formateurRepository,
      UserServices $file,
      EntityManagerInterface $manager,
      ProfileRepository $profilripo,
      UserPasswordEncoderInterface $encoder
      )
    {   
         $user = $file->updateUser($request, $formateurRepository, $profilripo, $manager, $encoder);
        //  dd($user);
        return $this->json($user, Response::HTTP_CREATED);
    }
}

