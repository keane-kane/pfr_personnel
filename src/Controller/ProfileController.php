<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Repository\ProfileRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{

 

   /**
     * @Route(
     *      path="api/admin/profils/{id}",
     *      methods={"GET"},
     *      defaults={
     *          "__controller"="App\Controller\ProfileController::getProfile",
     *          "__api_resource_class"=Profile::class
     *     }
     * )
     */
    // public function getProfile(Profile $profil)
    // {
    //     dd("test");
    //     //return $this->json($profil, Response::HTTP_OK);
    // }

    /**
     * @Route(
     *      path="/api/admin/profils/{id}/users",
     *      name="get_user_in_profil",
     *      methods={"GET"}
     * )
     */
    public function getUserInProfile(Profile $profil)
    {
        
        $users = $profil->getUsers();
        // dd($users);
        return $this->json($users, Response::HTTP_OK);
    }
}
