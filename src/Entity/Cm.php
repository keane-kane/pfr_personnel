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
 *     },
 *     collectionOperations={
 *        "GET"={
 *              "path"="/users/cm",
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *         }, 
 *        "POST"={
 *              "path"="/users/cm",
 *              "security"="is_granted('EDIT')",
 *              "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *         }
 *      },
 *     itemOperations={
 *         "GET"={
 *              "path"="/users/cm/{id}", 
 *              "security"="is_granted('VIEW')",
 *              "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *          },
 *         "PUT"={
 *              "path"="/users/cm/{id}",
 *              "security"="is_granted('PUT')",
 *              "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *           },
 *          "DELETE"={
 *                "path"="/users/cm/{id}",
 *              "security"="is_granted('DELETE')",
 *              "security_message"="Acces refusé vous n'avez pas l'autorisation" 
 *            }
 *       }
 * )
 */
class Cm extends User
{
      /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    
    public function getId(): ?int
    {
        return $this->id;
    }
  
}
