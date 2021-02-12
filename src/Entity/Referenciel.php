<?php

namespace App\Entity;

use App\Entity\Promo;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReferencielRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *       routePrefix= "admin",
 *       denormalizationContext ={"groups"={"ref:write"}},
 *       normalizationContext   ={"groups"={"ref:read"}},
 *      attributes={
 *      },
 *      collectionOperations={
 *        "GET"={
 *              "path"="/referenciels"
 *         }, 
 *         "get_grpcomptence_in_ref"={
 *                "path"="/referenciels/grpcompetences",
 *                "method" = "GET",
 *          },
 *        "POST"={
 *              "path"="/referenciels"
 *         }
 *      },
 *     itemOperations={
 *         "GET"={
 *              "path"="/referenciels/{id}"
 *          },
 *          "get_grpcomptence_in_ref"={
 *                "path"="/referenciels/{id_ref}/grpcompetences/{id}",
 *                "method" = "GET",
 *          },
 *         "PUT"={
 *              "path"="/referenciels/{id}"
 *           },
 *          "DELETE"={
 *                "path"="/referenciels/{id}"
 *            }
 *   }
 *      
 * )
 * @ORM\Entity(repositoryClass=ReferencielRepository::class)
 */
class Referenciel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"ref:read", "ref:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"ref:read",  "ref:write"})
     *
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"ref:read",  "ref:write"})
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"ref:read",  "ref:write"})
     */
    private $competence_viser;

    /**
     * @ORM\Column(type="blob", nullable = true)
     * @Groups({"ref:read",  "ref:write"})
     */
    private $programmes;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"ref:read",  "ref:write"})
     */
    private $criteres_evaluation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"ref:read",  "ref:write"})
     */
    private $criteres_admission;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"ref:read",  "ref:write"})
     */
    private $archive = 0;

    /**
     * @ORM\ManyToMany(targetEntity=GroupCompetence::class, mappedBy="referenciel")
     * @Groups({"ref:read",  "ref:write"})
     */
    private $groupeCompetences;

    /**
     * @ORM\ManyToMany(targetEntity=Promo::class, inversedBy="referenciels")
     * @Groups({"ref:read",  "ref:write"})
     */
    private $promos;

  
    public function __construct()
    {
        $this->groupeCompetences = new ArrayCollection();
        $this->promos = new ArrayCollection();
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

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getCompetenceViser(): ?string
    {
        return $this->competence_viser;
    }

    public function setCompetenceViser(string $competence_viser): self
    {
        $this->competence_viser = $competence_viser;

        return $this;
    }

    public function getProgrammes()
    {
        $programmes = @stream_get_contents($this->programmes);
        @fclose($this->programmes);
        return base64_encode($programmes);
    }

    public function setProgrammes( $programmes): self
    {
        $this->programmes = $programmes;

        return $this;
    }

    public function getCriteresEvaluation(): ?string
    {
        return $this->criteres_evaluation;
    }

    public function setCriteresEvaluation(string $criteres_evaluation): self
    {
        $this->criteres_evaluation = $criteres_evaluation;

        return $this;
    }

    public function getCriteresAdmission(): ?string
    {
        return $this->criteres_admission;
    }

    public function setCriteresAdmission(string $criteres_admission): self
    {
        $this->criteres_admission = $criteres_admission;

        return $this;
    }

    public function getArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(?bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupeCompetences(): Collection
    {
        return $this->groupeCompetences;
    }

    public function addGroupeCompetence(GroupCompetence $groupeCompetence): self
    {
        if (!$this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences[] = $groupeCompetence;
            $groupeCompetence->addReferenciel($this);
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupCompetence $groupeCompetence): self
    {
        if ($this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences->removeElement($groupeCompetence);
            $groupeCompetence->removeReferenciel($this);
        }

        return $this;
    }

    /**
     * @return Collection|Promo[]
     */
    public function getPromos(): Collection
    {
        return $this->promos;
    }

    public function addPromo(Promo $promo): self
    {
        if (!$this->promos->contains($promo)) {
            $this->promos[] = $promo;
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        $this->promos->removeElement($promo);

        return $this;
    }

 
}