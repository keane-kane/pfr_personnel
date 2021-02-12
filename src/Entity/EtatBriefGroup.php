<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtatBriefGroupRepository;

/**
 * @ORM\Entity(repositoryClass=EtatBriefGroupRepository::class)
 */
class EtatBriefGroup
{
  
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Brief::class, inversedBy="etatBriefGroups")
     * @Id
     */
    private $etatbriefs;

    /**
     * @ORM\ManyToOne(targetEntity=Groupe::class, inversedBy="etatBriefGroups")
     * @Id
     */
    private $etatgroup;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtatbriefs(): ?Brief
    {
        return $this->etatbriefs;
    }

    public function setEtatbriefs(?Brief $etatbriefs): self
    {
        $this->etatbriefs = $etatbriefs;

        return $this;
    }

    public function getEtatgroup(): ?Groupe
    {
        return $this->etatgroup;
    }

    public function setEtatgroup(?Groupe $etatgroup): self
    {
        $this->etatgroup = $etatgroup;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }
}
