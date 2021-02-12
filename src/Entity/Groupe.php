<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 * @ApiResource(
 *      routePrefix = "admin",
 *      denormalizationContext ={"groups"={"grpe:write"}},
 *      normalizationContext   ={"groups"={"grpe:read"}},
 *      attributes={
 *      },
 *      collectionOperations={
 *        "GET"={
 *              "path"="/groupes"
 *         }, 
 *        "POST"={
 *              "path"="/groupes"
 *         }
 *      },
 *     itemOperations={
 *         "GET"={
 *              "path"="/groupes/{id}"
 *          },
 *         "PUT"={
 *              "path"="/groupes/{id}"
 *           },
 *          "DELETE"={
 *                "path"="/admin/groupes/{id}"
 *            }
 *   }
 * )
 */
class Groupe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * groups"={"grpe:read"}
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grpe:read", "grpe:write"})
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"grpe:read", "grpe:write"})
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"grpe:read", "grpe:write"})
     */
    private $archive = 0;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="groupes", cascade={"persist"})
     * @Groups({"grpe:read", "grpe:write"})
     
     */
    private $formateurs;

    /**
     * @ORM\ManyToMany(targetEntity=Apprenant::class, inversedBy="groupes", cascade={"persist"})
     * @Groups({"grpe:read", "grpe:write"})
    
     */
    private $composer;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="groupes",cascade={"persist"}))
     * @Groups({"grpe:read", "grpe:write"})
     
     */
    private $promos;

    /**
     * @ORM\OneToMany(targetEntity=EtatBriefGroup::class, mappedBy="etatgroup", cascade={"persist"}))
     * @Groups({"grpe:read", "grpe:write"})
     */
    private $etatBriefGroups;

    public function __construct()
    {
        $this->formateurs = new ArrayCollection();
        $this->composer = new ArrayCollection();
        $this->etatBriefGroups = new ArrayCollection();
    }
    

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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

    /**
     * @return Collection|Formateur[]
     */
    public function getFormateurs(): Collection
    {
        return $this->formateurs;
    }

    public function addFormateur(Formateur $formateur): self
    {
        if (!$this->formateurs->contains($formateur)) {
            $this->formateurs[] = $formateur;
        }

        return $this;
    }

    public function removeFormateur(Formateur $formateur): self
    {
        $this->formateurs->removeElement($formateur);

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getComposer(): Collection
    {
        return $this->composer;
    }

    public function addComposer(Apprenant $composer): self
    {
        if (!$this->composer->contains($composer)) {
            $this->composer[] = $composer;
        }

        return $this;
    }

    public function removeComposer(Apprenant $composer): self
    {
        $this->composer->removeElement($composer);

        return $this;
    }

    public function getPromos(): ?Promo
    {
        return $this->promos;
    }

    public function setPromos(?Promo $promos): self
    {
        $this->promos = $promos;

        return $this;
    }

    /**
     * @return Collection|EtatBriefGroup[]
     */
    public function getEtatBriefGroups(): Collection
    {
        return $this->etatBriefGroups;
    }

    public function addEtatBriefGroup(EtatBriefGroup $etatBriefGroup): self
    {
        if (!$this->etatBriefGroups->contains($etatBriefGroup)) {
            $this->etatBriefGroups[] = $etatBriefGroup;
            $etatBriefGroup->setEtatgroup($this);
        }

        return $this;
    }

    public function removeEtatBriefGroup(EtatBriefGroup $etatBriefGroup): self
    {
        if ($this->etatBriefGroups->removeElement($etatBriefGroup)) {
            // set the owning side to null (unless already changed)
            if ($etatBriefGroup->getEtatgroup() === $this) {
                $etatBriefGroup->setEtatgroup(null);
            }
        }

        return $this;
    }


}
