<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * @ApiResource(
 *      routePrefix= "admin",
*       attributes={
*         "pagination_items_per_page"=2,
*          "security"="is_granted('ROLE_ADMIN')",
*          "security_message"="Acces refusé vous n'avez pas l'autorisation"
*     },
*    collectionOperations={
*        "GET"={
*              "path"="/users/formateurs"
*         }, 
*        "POST"={
*              "path"="/users/formateurs"
*         }
*      },
*     itemOperations={
*         "GET"={
*              "path"="/users/formateurs/{id}"
*          },
*         "PUT"={
*              "path"="/users/formateurs/{id}"
*           },
*          "DELETE"={
*                "path"="/users/formateurs/{id}"
*            }
*   }
 * )
 */
class Formateur extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
