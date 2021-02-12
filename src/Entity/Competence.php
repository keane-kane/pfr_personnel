<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 * @ApiResource(
 *      
 *       normalizationContext={"groups"={"competence:read"}},
 *       denormalizationContext={"groups"={"competence:write"}},
 *      routePrefix  = "/admin/",
 *    
 *      collectionOperations={
 *          "GET"={
 *              "path" = "/competences",
 *          },
 *          "POST"={
 *              "path" = "/competences",
 *          }
 *     },
 *     itemOperations={
 *          "GET"={
 *              "path" = "/competences/{id}",
 *          },
 *          "PUT"={
 *              "method" = "PUT",
 *              "path" = "/competences/{id}",
 *          },
 *         "DELETE"={
 *              "path"="/competences/{id}",
 *          }
 *     }
 * 
 * )
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"competence:read","grpecompetence:read", "grpecompetence:write", "niveau:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:read", "competence:write",
     * "grpecompetence:write","grpecompetence:read",
     * "niveau:read"
     * })
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:read", "competence:write",
     * "grpecompetence:write","grpecompetence:read",
     * "niveau:read"
     * })
     */
    private $descriptif;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"competence:read", "competence:write","grpecompetence:write","grpecompetence:read"})
     */
    private $archive;

    /**
     * @ORM\ManyToMany(targetEntity=GroupCompetence::class, inversedBy="competences")
     * @Groups({"competence:read", "competence:write"})
     */
    private $former;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="competence", cascade={"persist"})
     * @Groups({"competence:read", "competence:write"})
     * @Assert\Count(
     *      min=3,
     *      max=3,
     *      minMessage="Au moins 3",
     *      maxMessage= "Au plus 3"
     * )
     */
    private $niveaux;

    public function __construct()
    {
        $this->former = new ArrayCollection();
        $this->niveaux = new ArrayCollection();
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
     * @return Collection|GroupCompetence[]
     */
    public function getFormer(): Collection
    {
        return $this->former;
    }

    public function addFormer(GroupCompetence $former): self
    {
        if (!$this->former->contains($former)) {
            $this->former[] = $former;
        }

        return $this;
    }

    public function removeFormer(GroupCompetence $former): self
    {
        $this->former->removeElement($former);

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux[] = $niveau;
            $niveau->setCompetence($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveaux->removeElement($niveau)) {
            // set the owning side to null (unless already changed)
            if ($niveau->getCompetence() === $this) {
                $niveau->setCompetence(null);
            }
        }

        return $this;
    }

 
}
