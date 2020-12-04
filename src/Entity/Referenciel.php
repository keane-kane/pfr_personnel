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
 * )
 * @ORM\Entity(repositoryClass=ReferencielRepository::class)
 */
class Referenciel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     *
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     *
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $competence_viser;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $programmes;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $criteres_evaluation;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $criteres_admission;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * 
     */
    private $archive = 0;

    /**
     * @ORM\ManyToMany(targetEntity=GroupCompetence::class, mappedBy="referenciel")
     */
    private $groupeCompetences;

    /**
     * @ORM\ManyToMany(targetEntity=Promo::class, inversedBy="referenciels")
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

    public function getProgrammes(): ?string
    {
        return $this->programmes;
    }

    public function setProgrammes(string $programmes): self
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