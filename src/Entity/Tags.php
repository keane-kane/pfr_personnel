<?php

namespace App\Entity;

use App\Entity\GroupTags;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      routePrefix="admin",
 *      denormalizationContext ={"groups"={"tags:write"}},
 *      normalizationContext   ={"groups"={"tags:read"}},
 *      collectionOperations   = {"GET","POST"},
 *      itemOperations         ={"GET","PUT","DELETE"},
 * )
 * @ORM\Entity(repositoryClass=TagsRepository::class)
 * 
 */
class Tags
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"tags:read","grptags:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tags:read", "tags:write","grptags:read", "grptags:write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tags:read", "tags:write","grptags:read", "grptags:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"tags:read", "tags:write","grptags:read", "grptags:write"})
     */
    private $archive;

    /**
     * @ORM\ManyToMany(targetEntity=GroupTags::class, inversedBy="tags")
     * @Groups({"tags:read", "tags:write"})
     */
    private $groupTags;

    /**
     * @ORM\ManyToMany(targetEntity=Brief::class, mappedBy="tags")
     */
    private $briefs;

    public function __construct()
    {
        $this->groupTags = new ArrayCollection();
        $this->briefs = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
     * @return Collection|GroupTags[]
     */
    public function getGroupTags(): Collection
    {
        return $this->groupTags;
    }

    public function addGroupTag(GroupTags $groupTag): self
    {
        if (!$this->groupTags->contains($groupTag)) {
            $this->groupTags[] = $groupTag;
        }

        return $this;
    }

    public function removeGroupTag(GroupTags $groupTag): self
    {
        $this->groupTags->removeElement($groupTag);

        return $this;
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
            $brief->addTag($this);
        }

        return $this;
    }

    public function removeBrief(Brief $brief): self
    {
        if ($this->briefs->removeElement($brief)) {
            $brief->removeTag($this);
        }

        return $this;
    }

   

}