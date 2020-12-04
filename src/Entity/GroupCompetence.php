<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GroupCompetenceRepository::class)
 * @ApiResource(
 *      normalizationContext={"groups"={"grpecompetence:read"}},
 *      denormalizationContext={"groups"={"grpecompetence:write"}},
 *      routePrefix ="admin",
 *  
 *     collectionOperations={
 *          "GET"={
 *              "path" = "/grpecompetences",
 *          },
 *          "get_competences"={
 *              "method" = "GET",
 *              "path" = "/grpecompetences/competences",
 *          },
 *          "POST"={
 *              "path" = "/grpecompetences",
 *          }
 *     },
 *     itemOperations={
 *          "GET"={
 *              "path" = "/grpecompetences/{id}",
 *              "requirements"={"id"="\d+"},
 * 
 *          },
 *          "get_competence_in_grpeCompetence"={
 *              "method" = "GET",
 *              "path" = "/grpecompetences/{id}/competences",
 *              "requirements"={"id"="\d+"},
 * 
 *          },
 *           "PUT"={
 *              "path"="/admin/grpeCompetences/{id}",
 *          },
 *         "DELETE"={
 *              "path"="grpeCompetences/{id}",
 *          }
 *     }
 * )
 */
class GroupCompetence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"competence:read","grpecompetence:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:read","competence:write", 
     *          "grpecompetence:write","grpecompetence:read"
     * })
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:read", "competence:write",
     *          "grpecompetence:write","grpecompetence:read"
     * })
     * 
     */
    private $descriptif;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"competence:read", "competence:write",
     * "grpecompetence:write","grpecompetence:read"
     *})
     */
    private $archive;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, mappedBy="former")
     * @Groups({ "grpecompetence:write","grpecompetence:read"})
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity=Referenciel::class, inversedBy="groupeCompetences")
     */
    private $referenciel;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->referenciel = new ArrayCollection();
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

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

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
     * @return Collection|Competence[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->addFormer($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            $competence->removeFormer($this);
        }

        return $this;
    }
    
    /**
     * @return Collection|Referenciel[]
     */
    public function getReferenciel(): Collection
    {
        return $this->referenciel;
    }

    public function addReferenciel(Referenciel $referenciel): self
    {
        if (!$this->referenciel->contains($referenciel)) {
            $this->referenciel[] = $referenciel;
        }

        return $this;
    }

    public function removeReferenciel(Referenciel $referenciel): self
    {
        if ($this->referenciel->contains($referenciel)) {
            $this->referenciel->removeElement($referenciel);
        }

        return $this;
    }
   
}
