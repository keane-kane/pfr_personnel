<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
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
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptif;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
     * @ORM\ManyToMany(targetEntity=GroupCompetence::class, mappedBy="EstFormer")
     */
    private $groupCompetences;

    public function __construct()
    {
        $this->groupCompetences = new ArrayCollection();
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
    public function getGroupCompetences(): Collection
    {
        return $this->groupCompetences;
    }

    public function addGroupCompetence(GroupCompetence $groupCompetence): self
    {
        if (!$this->groupCompetences->contains($groupCompetence)) {
            $this->groupCompetences[] = $groupCompetence;
            $groupCompetence->addEstFormer($this);
        }

        return $this;
    }

    public function removeGroupCompetence(GroupCompetence $groupCompetence): self
    {
        if ($this->groupCompetences->removeElement($groupCompetence)) {
            $groupCompetence->removeEstFormer($this);
        }

        return $this;
    }
}
