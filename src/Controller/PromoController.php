<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Entity\Promo;
use App\Entity\Apprenant;
use App\Repository\GroupeRepository;
use App\Repository\PromoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PromoController extends AbstractController
{
   
    /**
     * @Route(
     *      path="/api/admin/promo",
     *      methods={"GET"}
     * )
     */
    public function all(PromoRepository $promos)
    {
        $promos = $promos->findByArchive("0");
        return $this->json($promos, Response::HTTP_OK);
    }

    /**
     * @Route(
     *      name="post_promos",
     *      path="api/admin/promo",
     *      methods={"POST"},
     *      defaults={
     *          "__controller"="App\Controller\Promos\PromosController::add",
     *          "__api_resource_class"=Promos::class,
     *          "__api_collection_operation_name"="add_promo"
     *     }
     * )
     */
    public function add(
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        EntityManagerInterface $manager,
        \Swift_Mailer $mailer
    ) {
        $data = $request->request->all();
        $avatar = $request->files->get("avatar");
        //dd($avatar);
        if($data == null){
            $data = json_decode($request->getContent(), true);
        }
       
        if ($avatar) {
            $avatar = fopen($avatar->getRealPath(), "rb");
            $data["avatar"] = $avatar;
        }
        $data = $serializer->denormalize($data, "App\Entity\Promos");
        $errors = $validator->validate($data);
        if (count($errors)) {
            $errors = $serializer->serialize($errors, "json");
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST, [], true);
        }
        $groupe = new Groupe();
        $apprenants = new Apprenant();
        $repository = $this->getDoctrine()->getRepository(Apprenant::class);
        $collectionsApprenants = $repository->findAll();
        $groupe->setNom("Groupe Principal");
        $groupe->setDateCreation(new \DateTime());
        for ($i = 0; $i < count($collectionsApprenants); $i++) {
            $groupe->addComposer($collectionsApprenants[$i]);
            try {
                if ($collectionsApprenants[$i]->getEmail()) {
                    $message = (new \Swift_Message('Selection Sonatel Academy'))
                        ->setFrom('ousmanediopp268@gmail')
                        ->setTo($collectionsApprenants[$i]->getEmail())
                        ->setBody("Bonjour cher(e)" . $collectionsApprenants[$i]->getPrenom() . " " . $collectionsApprenants[$i]->getNom() . ".\n Félicitation! Vous avez été selectionné(e) suite à votre test d'entré à la Sonatel Academy.Veuillez utiliser ces informations pour vous connecter à votre promo.\n username:" . $collectionsApprenants[$i]->getUsername() . " mot de passe:" . $collectionsApprenants[$i]->getPlainPassword() . ".\n A bientot.");


                    $mailer->send($message);
                }
            } catch (\Throwable $th) {
                echo "error";
            }
        }
        $groupe->setArchive(0);
        $manager->persist($groupe);
        $data->addGroupe($groupe);
        $manager->persist($data);
      //  $manager->flush();
        if ($avatar) {
            fclose($avatar);
        }
        return $this->json($data->normalize($data), Response::HTTP_CREATED);
    }

    /**
     * @Route(
     *      name="get_promo",
     *      path="/api/admin/promo/{id}",
     *      methods={"GET"},
     *      defaults={
     *          "__controller"="App\Controller\Promos\PromosController::show",
     *          "__api_resource_class"=Promos::class,
     *          "__api_collection_operation_name"="get_promo"
     *     }
     * )
     */
    public function show(Promo $promos)
    {
        return $this->json($promos, Response::HTTP_OK);
    }

    /**
     * @Route(
     *  name="get_apprenant",
     *      path="/api/admin/promo/{id}/groupes/{id_app}/apprenants",
     *      methods={"GET"}
     * )
     */
    public function getApprenantInGroupePromos($id, $id_app, PromoRepository $promos, GroupeRepository $groupe)
    {
        $promo = $promos->findBy(['id' => $id]);
        $ArrayGroupe = $groupe->findOneBy(['id' => $id_app, "promos" => $promo]);
        return $this->json($ArrayGroupe->getComposer(), Response::HTTP_OK);
    }

}
