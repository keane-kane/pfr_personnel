<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 * @ApiResource(
 *      routePrefix= "admin",
 *     attributes={
 *         "pagination_items_per_page"=20,
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *     },
 *     collectionOperations={
 *          "get"={
 *                "path"="/users"
 *              }, 
 *          "post"={
 *                "path"="/users"
 *              }
 *      },
 *     itemOperations={
 *         "GET"={
 *              "path"="/{id}/users"
 *            },
 *         "PUT"={
 *             "path"="/{id}/users"
 *          },
 *      "DELETE"={
 *             "path"="/{id}/users"
 *          },
 *  }
 * )
 */
class Admin extends User
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
