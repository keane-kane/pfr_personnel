<?php

namespace App\Entity;

use App\Repository\GroupCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupCompetenceRepository::class)
 */
class GroupCompetence
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
    private $lebelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptif;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, inversedBy="groupCompetences")
     */
    private $EstFormer;

    public function __construct()
    {
        $this->EstFormer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLebelle(): ?string
    {
        return $this->lebelle;
    }

    public function setLebelle(string $lebelle): self
    {
        $this->lebelle = $lebelle;

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
    public function getEstFormer(): Collection
    {
        return $this->EstFormer;
    }

    public function addEstFormer(Competence $estFormer): self
    {
        if (!$this->EstFormer->contains($estFormer)) {
            $this->EstFormer[] = $estFormer;
        }

        return $this;
    }

    public function removeEstFormer(Competence $estFormer): self
    {
        $this->EstFormer->removeElement($estFormer);

        return $this;
    }
}
