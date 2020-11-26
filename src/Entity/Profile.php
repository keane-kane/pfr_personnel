<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfileRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * @ORM\Entity(repositoryClass=ProfileRepository::class) 
 * @ApiFilter(BooleanFilter::class, properties={"archive"=false})
 * @ApiResource(
 *    routePrefix= "admin",
 *    attributes={
 *         "pagination_items_per_page"=20,
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *     },
 *     collectionOperations={
 *          "get"={
 *                "path"="/profils"
 *              },
*             "post"={
*                "path"="/profils"
*              }
 *           },
 *     itemOperations={
 *         "GET"={
 *              "path"="/profils/{id}",
 *              },
 *         "DELETE"={
 *                "path"="/profils/{id}",
 *              },
 *          "get_user_in_profil"={
 *                "path"="/profils/{id}/users",
 *                "method"="GET",
 *              }
 *  }
 * )
 */
class Profile
{
   /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;
    
  /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Le Libelle est obligatoire")
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil" ,cascade={"persist","remove"})
     * ApiSubresource()
     */
    private $users;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @Assert\NotBlank(message="Le Libelle est obligatoire")
     */
    private $archive = 0;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfil($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getProfil() === $this) {
                $user->setProfil(null);
            }
        }

        return $this;
    }

    public function getArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }
}