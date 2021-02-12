<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * @ApiResource(
 *      routePrefix= "admin",
*       attributes={
*         "pagination_items_per_page"=2,
*      },
*      collectionOperations={
*        "GET"={
*              "path"="/users/formateurs",
*              "security"="is_granted('ROLE_ADMIN' or 'ROLE_CM')",
*              "security_message"="Acces refusé vous n'avez pas l'autorisation"
*         }, 
*        "POST"={
*              "path"="/users/formateurs",
    *          "security"="is_granted('EDIT', object)",
    *          "security_message"="Acces refusé vous n'avez pas l'autorisation"
*         }
*      },
*     itemOperations={
*         "GET"={
*              "path"="/users/formateurs/{id}",
*              "security"="is_granted('VIEW')",
*              "security_message"="Acces refusé vous n'avez pas l'autorisation"
*          },

*         "PUT"={
*              "path"="/users/formateurs/{id}",
*              "security"="is_granted('PUT')",
*              "security_message"="Acces refusé vous n'avez pas l'autorisation"
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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity=Brief::class, mappedBy="formateur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $briefs;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="formateurs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $groupes;

    public function __construct()
    {
        $this->briefs = new ArrayCollection();
        $this->groupes = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Brief[]
     */
    public function getBriefs(): Collection
    {
        return $this->briefs;
    }

    public function addBrief(Brief $brief): self
    {
        if (!$this->briefs->contains($brief)) {
            $this->briefs[] = $brief;
            $brief->setFormateur($this);
        }

        return $this;
    }

    public function removeBrief(Brief $brief): self
    {
        if ($this->briefs->removeElement($brief)) {
            // set the owning side to null (unless already changed)
            if ($brief->getFormateur() === $this) {
                $brief->setFormateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addFormateur($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeFormateur($this);
        }

        return $this;
    }
}
