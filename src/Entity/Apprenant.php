<?php

namespace App\Entity;

use App\Repository\ApprenantRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 *  @ApiResource(
 *      routePrefix="admin",
 *     attributes={
 *        "pagination_items_per_page"=20,
 *        "security"="is_granted('ROLE_ADMIN')",
 *         "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *     },
 *     collectionOperations={
 *        "GET"={
 *              "path"="/users/apprenants"
 *         }, 
 *        "POST"={
 *              "path"="/users/apprenants"
 *         }
 *      },
 *     itemOperations={
 *         "GET"={
 *              "path"="/users/apprenants/{id}"
 *          },
 *         "PUT"={
 *              "path"="/users/apprenants/{id}"
 *           },
 *          "DELETE"={
 *                "path"="/users/apprenants/{id}"
 *            }
 *       }
 * )
 */
class Apprenant extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity=ProfilSortie::class, inversedBy="profilsorti")
     */
    private $profilSortie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfilSortie(): ?ProfilSortie
    {
        return $this->profilSortie;
    }

    public function setProfilSortie(?ProfilSortie $profilSortie): self
    {
        $this->profilSortie = $profilSortie;

        return $this;
    }
}
