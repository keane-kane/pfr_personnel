<?php

namespace App\Entity;

use App\Repository\CmRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ORM\Entity(repositoryClass=CmRepository::class)
 * @ApiResource(
 *    routePrefix= "admin",
 *    attributes={
 *         "pagination_items_per_page"=20,
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *     },
 *     collectionOperations={
 *        "GET"={
 *              "path"="/users/cm"
 *         }, 
 *        "POST"={
 *              "path"="/users/cm"
 *         }
 *      },
 *     itemOperations={
 *         "GET"={
 *              "path"="/users/cm/{id}"
 *          },
 *         "PUT"={
 *              "path"="/users/cm/{id}"
 *           },
 *          "DELETE"={
 *                "path"="/users/cm/{id}"
 *            }
 *       }
 * )
 */
class Cm extends User
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
