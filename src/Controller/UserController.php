<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProfileRepository;
use App\Services\UserServices;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{ 
   

    public const USER = "App\Entity\User";
    
    // /**
    //  * @Route(
    //  *      path="api/users/{id}",
    //  *      methods={"GET"}
    //  * )
    //  */
    // public function getProfile(User $user)
    // {
    //     return $this->json($user, Response::HTTP_OK);
    // }

    /**
     * @Route(
     *      path="api/users",
     *      methods={"GET"}
     * )
     */
    public function getProfil(UserRepository $repo)
    {
       
        $profil = $repo->findBy(['archive' => false]);
         //dd($profil);
         return $this->json($profil);
    }

}
