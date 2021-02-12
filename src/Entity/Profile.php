<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfileRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * @ORM\Entity(repositoryClass=ProfileRepository::class) 
 * @ApiFilter(BooleanFilter::class, properties={"archive"=false})
 * @ApiResource(
 *    routePrefix= "/admin",
 * 
 *      denormalizationContext ={"groups"={"profil:write"}},
 *      normalizationContext   ={"groups"={"profil:read"}},
 *    attributes={
 *         "pagination_items_per_page"=20,
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "security_message"="Acces refusé vous n'avez pas l'RTRYUTIOIUYT"
 *     },
 *     collectionOperations={
 *          "GET"={
 *                "path"="/profils",
 *              },
 *           "get_user_in_profil"={
 *                "path"="/profils/{id}/users",
 *                "method"="GET",
 *              },
 *             "POST"={
 *                "path"="/profils",
 *              }
 *           },
 *     itemOperations={
 *         "GET"={
 *              "path"="/profils/{id}",
 *              "method"="GET",
 *              },
 *         "DELETE"={
 *                "path"="/profils/{id}",
 *                "method"="DELETE",
 *              },
 *         
 *  }
 * )
 */
class Profile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"profil:read", "profil:write"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Le Libelle est obligatoire")
     * @Groups({"profil:read", "profil:write"})
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil" ,cascade={"persist","remove"})
     * @ApiSubresource()
     * @Groups({"profil:read"})
     * 
     */
    private $users;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @Assert\NotBlank(message="Le Libelle est obligatoire")
     * @Groups({"profil:read", "profil:write"})
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
