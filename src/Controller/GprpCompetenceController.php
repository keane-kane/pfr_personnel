<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GprpCompetenceController extends AbstractController
{
    /**
     * @Route("/gprp/competence", name="gprp_competence")
     */
    public function index(): Response
    {
        return $this->render('gprp_competence/index.html.twig', [
            'controller_name' => 'GprpCompetenceController',
        ]);
    }
}
