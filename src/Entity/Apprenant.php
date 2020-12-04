<?php

namespace App\Entity;

use App\Repository\ApprenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 *  @ApiResource(
 *      routePrefix="admin",
 *     attributes={
 *         "pagination_items_per_page"=20,
*          "security"="is_granted('ROLE_ADMIN' or 'ROLE_FORMATEUR')",
*          "security_message"="Acces refusé vous n'avez pas l'autorisation"
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
 *              "path"="/users/apprenants/{id}",
 *              "security"="is_granted('ROLE_APPRENANT')",
 *              "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *          },
 *         "PUT"={
 *              "path"="/users/apprenants/{id}",
 *              "security"="is_granted('ROLE_APPRENANT')",
 *              "security_message"="Acces refusé vous n'avez pas l'autorisation"
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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @ORM\ManyToOne(targetEntity=ProfilSortie::class, inversedBy="profilsorti")
     */
    private $profilSortie;

    /**
     * @ORM\OneToMany(targetEntity=CompetenceValides::class, mappedBy="apprenant")
     */
    private $competenceValides;

    public function __construct()
    {
        $this->competenceValides = new ArrayCollection();
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

    /**
     * @return Collection|CompetenceValides[]
     */
    public function getCompetenceValides(): Collection
    {
        return $this->competenceValides;
    }

    public function addCompetenceValide(CompetenceValides $competenceValide): self
    {
        if (!$this->competenceValides->contains($competenceValide)) {
            $this->competenceValides[] = $competenceValide;
            $competenceValide->setApprenant($this);
        }

        return $this;
    }

    public function removeCompetenceValide(CompetenceValides $competenceValide): self
    {
        if ($this->competenceValides->removeElement($competenceValide)) {
            // set the owning side to null (unless already changed)
            if ($competenceValide->getApprenant() === $this) {
                $competenceValide->setApprenant(null);
            }
        }

        return $this;
    }
}
