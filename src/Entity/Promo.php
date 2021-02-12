<?php

namespace App\Entity;

use App\Entity\Referenciel;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PromoRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=PromoRepository::class)
  * @ApiResource(
        routePrefix = "amdin",
 *      attributes={
 *         "pagination_enabled"=false
 *     },
 *     collectionOperations={
 *          "GET"={
 *              "path"="/promo",
 *          },
 *          "getGroupePrincipalInPromos"={
 *              "method"="GET",
 *              "path"="/admin/principal",
 *              "controller"=App\Controller\Promos\GroupePrincipalInPromos::class
 *          }, 
 *           "get_apprenant_attente"={
 *              "method"="GET",
 *              "path"="/admin/promo/apprenants/attente",
 *              "controller"=App\Controller\Promos\ApprenantEnAttente::class
 *          }, 
 *          "post"={
 *              "path"="/promo",
 *              "security" = "is_granted('ROLE_ADMIN')",
 *              "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *          }
 *      },
 *     itemOperations={
 *         "GET"={
 *              "path"="/promo/{id}",
 *               "security" = "is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR')",
 *              "security_message"="Acces refusé vous n'avez pas l'autorisation"
 * *            },
 *          "get_groupePrincipal_in_promo"={
 *              "method"="GET",
 *              "path"="/promo/{id}/principal",
 *              "controller"=App\Controller\Promos\GroupePrincipalInPromo::class
 *          },
 *          "get_referenciels_in_promo"={
 *              "method"="GET",
 *              "path"="/promo/{id}/referenciels",
 *              "controller"=App\Controller\Promos\ReferencielInPromos::class
 *          },
 *          "get_formateurs_in_promo"={
 *              "method"="GET",
 *              "path"="/promo/{id}/formateurs",
 *              "controller"=App\Controller\Promos\FormateursInPromo::class
 *          },     
 *         "PUT"={
 *              "path"="/promo/{id}",
 *              "security" = "is_granted('ROLE_ADMIN')",
 *              "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *              }
 *  }
 * )
 */
class Promo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCloture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fabrique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referenceAgate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="blob")
     */
    private $avatar;

    /**
     * @ORM\ManyToMany(targetEntity=profilSortie::class, inversedBy="promos",cascade={"persist"}))
     */
    private $promoprofilsorti;

    /**
     * @ORM\OneToMany(targetEntity=CompetenceValides::class, mappedBy="promo",cascade={"persist"}))
     */
    private $competenceValides;

    /**
     * @ORM\ManyToMany(targetEntity=Referenciel::class, mappedBy="promos",cascade={"persist"}))
     */
    private $referenciels;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="promos",cascade={"persist"}))
     */
    private $groupes;


    public function __construct()
    {
        $this->promoprofilsorti = new ArrayCollection();
        $this->competenceValides = new ArrayCollection();
        $this->referenciels = new ArrayCollection();
        $this->groupes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateCloture(): ?\DateTimeInterface
    {
        return $this->dateCloture;
    }

    public function setDateCloture(\DateTimeInterface $dateCloture): self
    {
        $this->dateCloture = $dateCloture;

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

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getFabrique(): ?string
    {
        return $this->fabrique;
    }

    public function setFabrique(string $fabrique): self
    {
        $this->fabrique = $fabrique;

        return $this;
    }

    public function getReferenceAgate(): ?string
    {
        return $this->referenceAgate;
    }

    public function setReferenceAgate(string $referenceAgate): self
    {
        $this->referenceAgate = $referenceAgate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAvatar()
    {
        $avatar = @stream_get_contents($this->avatar);
        @fclose($this->avatar);
        return base64_encode($avatar);
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection|profilSortie[]
     */
    public function getPromoprofilsorti(): Collection
    {
        return $this->promoprofilsorti;
    }

    public function addPromoprofilsorti(profilSortie $promoprofilsorti): self
    {
        if (!$this->promoprofilsorti->contains($promoprofilsorti)) {
            $this->promoprofilsorti[] = $promoprofilsorti;
        }

        return $this;
    }

    public function removePromoprofilsorti(profilSortie $promoprofilsorti): self
    {
        $this->promoprofilsorti->removeElement($promoprofilsorti);

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
            $competenceValide->setPromo($this);
        }

        return $this;
    }

    public function removeCompetenceValide(CompetenceValides $competenceValide): self
    {
        if ($this->competenceValides->removeElement($competenceValide)) {
            // set the owning side to null (unless already changed)
            if ($competenceValide->getPromo() === $this) {
                $competenceValide->setPromo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Referenciel[]
     */
    public function getReferenciels(): Collection
    {
        return $this->referenciels;
    }

    public function addReferenciel(Referenciel $referenciel): self
    {
        if (!$this->referenciels->contains($referenciel)) {
            $this->referenciels[] = $referenciel;
            $referenciel->addPromo($this);
        }

        return $this;
    }

    public function removeReferenciel(Referenciel $referenciel): self
    {
        if ($this->referenciels->removeElement($referenciel)) {
            $referenciel->removePromo($this);
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
            $groupe->setPromos($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getPromos() === $this) {
                $groupe->setPromos(null);
            }
        }

        return $this;
    }
}
