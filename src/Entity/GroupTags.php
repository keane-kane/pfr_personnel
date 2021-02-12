<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupTagsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      routePrefix="admin",
 *      denormalizationContext ={"groups"={"grptags:write"}},
 *      normalizationContext   ={"groups"={"grptags:read"}},
 * 
 *      collectionOperations   ={"GET"= { "path" = "/grptags",},
 * 
 *                               "POST" = { "path" = "/grptags"},
 *                              },
 * 
 *      itemOperations         ={"GET"= { "path" = "/grptags/{id}",},
 * 
 *                              "PUT"={ "path" = "/grptags/{id}",},
 * 
 *                              "get_tag_in_grptags" = 
 *                               {
 *                                   
 *                                   "path"="/grptags/{id}/tags",
 *                                   "method"="GET",
 *                               },
 *                               "DELETE" = { "path" = "/grptags/{id}",}
 *                             },
 * )
 * @ORM\Entity(repositoryClass=GroupTagsRepository::class)
 */
class GroupTags
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"tags:read", "grptags:read", "tags:write"})
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grptags:read", "grptags:write","tags:read", "tags:write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grptags:read", "grptags:write","tags:read", "tags:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"grptags:read", "grptags:write","tags:read", "tags:write"})
     */
    private $archive;

    /**
     * @ORM\ManyToMany(targetEntity=Tags::class, mappedBy="groupTags",cascade={"persist"})
     * @ApiSubresource()
     * @Groups({"grptags:read", "grptags:write"})
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

  

    /**
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of archive
     */ 
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set the value of archive
     *
     * @return  self
     */ 
    public function setArchive($archive)
    {
        $this->archive = $archive;

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
            $tag->addGroupTag($this);
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeGroupTag($this);
        }

        return $this;
    }
}
