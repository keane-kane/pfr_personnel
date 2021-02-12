<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BriefRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * 
 *      routePrefix = "admin",
 *      denormalizationContext ={"groups"={"briefs:write"}},
 *      normalizationContext   ={"groups"={"briefs:read"}},
 * 
 * )
 * @ORM\Entity(repositoryClass=BriefRepository::class)
 */
class Brief
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)*
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $contexte;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $modalitePedagogigue;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $critereEvaluation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $modaliteEvaluation;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Groups({"briefs:read", "briefs:write"})
     * 
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $statut;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $archive;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $createdAt;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $etat;

    /**
     * @ORM\ManyToMany(targetEntity=Tags::class, inversedBy="briefs")
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity=Formateur::class, inversedBy="briefs")
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $formateur;

    /**
     * @ORM\ManyToMany(targetEntity=Niveau::class, inversedBy="briefs")
     * @Groups({"briefs:read", "briefs:write"})
     */
    private $niveaux;

    /**
     * @ORM\OneToMany(targetEntity=EtatBriefGroup::class, mappedBy="etatbriefs", cascade={"persist", "remove"})
     * @Groups({"briefs:read", "briefs:write"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $etatBriefGroups;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->niveaux = new ArrayCollection();
        $this->etatBriefGroups = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    public function getContexte(): ?string
    {
        return $this->contexte;
    }

    public function setContexte(string $contexte): self
    {
        $this->contexte = $contexte;

        return $this;
    }

    public function getModalitePedagogigue(): ?string
    {
        return $this->modalitePedagogigue;
    }

    public function setModalitePedagogigue(string $modalitePedagogigue): self
    {
        $this->modalitePedagogigue = $modalitePedagogigue;

        return $this;
    }

    public function getCritereEvaluation(): ?string
    {
        return $this->critereEvaluation;
    }

    public function setCritereEvaluation(string $critereEvaluation): self
    {
        $this->critereEvaluation = $critereEvaluation;

        return $this;
    }

    public function getModaliteEvaluation(): ?string
    {
        return $this->modaliteEvaluation;
    }

    public function setModaliteEvaluation(string $modaliteEvaluation): self
    {
        $this->modaliteEvaluation = $modaliteEvaluation;

        return $this;
    }

    public function getAvatar()
    {
      
        return base64_encode(stream_get_contents($this->avatar));
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection|Tags[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getFormateur(): ?Formateur
    {
        return $this->formateur;
    }

    public function setFormateur(?Formateur $formateur): self
    {
        $this->formateur = $formateur;

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
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        $this->niveaux->removeElement($niveau);

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
            $etatBriefGroup->setEtatbriefs($this);
        }

        return $this;
    }

    public function removeEtatBriefGroup(EtatBriefGroup $etatBriefGroup): self
    {
        if ($this->etatBriefGroups->removeElement($etatBriefGroup)) {
            // set the owning side to null (unless already changed)
            if ($etatBriefGroup->getEtatbriefs() === $this) {
                $etatBriefGroup->setEtatbriefs(null);
            }
        }

        return $this;
    }

    


    
}
