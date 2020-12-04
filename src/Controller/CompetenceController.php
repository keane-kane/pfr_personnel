<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Entity\GroupeCompetence;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CompetenceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompetenceController extends AbstractController
{
      /**
     * @Route(
     *      name="create_Competence",
     *      path="/admin/competences",
     *      methods={"POST"},
     *      
     * )
     */

// public function add(
//       Request $request,
//       SerializerInterface $serializer,
//       ValidatorInterface $validator,
//       EntityManagerInterface $manager
//   ) 
//   {
//       $data = $request->request->all();
//       $data = $serializer-> ($data, "App\Entity\Competence");
//       $errors = $validator->validate($data);
//       if (count($errors)) {
//           $errors = $serializer->serialize($errors, "json");
//           return new JsonResponse($errors, Response::HTTP_BAD_REQUEST, [], true);
//       } 
//       $competence = new Competence();
//       $niveau= new Niveau();
//       $groupe = new GroupeCompetence();
//       $repository = $this->getDoctrine()->getRepository(GroupeCompetence::class);
//       $collectionsGroup = $repository->findAll();
//       for ($i = 0; $i < count($collectionsGroup); $i++) {
//           $competence->addGroupeCompetence($collectionsGroup[$i]);
//       }
//       $reposy = $this->getDoctrine()->getRepository(Niveau::class);
//       $collectNiveau =$reposy->findAll();
//       for ($i = 0; $i < count($collectNiveau); $i++) {
//         $competence->addNiveau($collectNiveau[$i]);
//     }
//       $manager->persist($competence);
//       $data->addGroupe($competence);
//       $manager->persist($data);
//       $manager->flush();
    
//       return $this->json($data->normalize($data), Response::HTTP_CREATED);
//   }
//     /**
//      * @Route(
//      *      path="/api/admin/competences",
//      *      methods={"GET"}
//      * )
//      */
//     public function getNiveau(CompetenceRepository $competenceRepository)
//     {
//         $competence= new Competences();
//         $competence = $competenceRepository->findBy([ "Archive" => false]);
//         $niveaux = [];
//         $size = count($competence);
//         for ($i = 0;$i < $size; $i++){
//             if(!$competence[$i]->getArchive()){
//                 $niveaux = $competence[$i]->getNiveaux();
//                 $length = count($niveaux);
//                 for ($j = 0; $j < $length; $j++){
//                     $Niveaux = $niveaux[$j];
//                     if(!$Niveaux->getArchive()){
//                         $niveaux[] = $competence;
//                     }
//                 }
//             }
//         }
//         return $this->json($Niveaux,Response::HTTP_OK);
//     }
//     /**
//      * @Route(
//      *      path="/api/admin/competences/id",
//      *      methods={"GET"}
//      * )
//      */

//     public function getNiveauById($niveau,CompetenceRepository $competenceRepository ,NiveauRepository $niveauRepository)
//     {
//         $competence = new Competence();
//         if(!($this->isGranted("VIEW",$competence)))
//             return $this->json(["message" => "Vous n'avez pas access à cette Ressource"],Response::HTTP_FORBIDDEN);
//         $competence = $competenceRepository->findOneBy(["niveau" => $niveau]);
//         if($competence){
//             if (!$competence->getArchive())
//                 return $this->json($competence,Response::HTTP_OK);
//         }
//         return $this->json(["message" => "Ressource inexistante"],Response::HTTP_NOT_FOUND);
//     }
//     /**
//      * @Route(
//      *     path="api/admin/competences/{id}",
//      *     methods={"PUT"},
//      *    
//      * )
//      */
//     public function editNiveau(
//         Request $request,
//         EntityManagerInterface $manager,
//         Competence $competence
//     ) {
//         $data = $request->request->all();
        
//         $competence->setArchive(0);
//         return $this->json($competence, Response::HTTP_CREATED);
//     }
}