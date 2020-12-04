<?php

namespace App\Controller;

use App\Entity\ProfilSortie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilSortieController extends AbstractController
{


    // /**
    //  * @Route(
    //  *      path="api/admin/profils/{id}",
    //  *      methods={"GET"}
    //  * )
    //  */
    // public function getProfilSortie(ProfilSortie $profilSortie)
    // {
    //     return $this->json($profilSortie, Response::HTTP_OK);
    // }

     /**
     * @Route(
     *      path="api/promo/{id}/profilsorties",
     *      name="getPromoByProfileSortie",
     *      methods={"GET"}
     * )
     */
    public function  getPromoByProfileSortie(): Response
    {
        return $this->render('profil_sortie/index.html.twig', [
            'controller_name' => 'ProfilSortieController',
        ]);
    }

     /**
     * @Route(
     *      path="api/promo/{id_p}/profilsorties/{id}",
     *      name="getApprenantByProfileSortieOnPromo",
     *      methods={"GET"}
     * )
     */
    public function  getApprenantByProfileSortieOnPromo($u): Response
    {
        return $this->render('profil_sortie/index.html.twig', [
            'controller_name' => 'ProfilSortieController',
        ]);
    }
}
