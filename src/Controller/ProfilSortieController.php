<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilSortieController extends AbstractController
{
    /**
     * @Route("/profil/sortie", name="profil_sortie")
     */
    public function index(): Response
    {
        return $this->render('profil_sortie/index.html.twig', [
            'controller_name' => 'ProfilSortieController',
        ]);
    }
}
