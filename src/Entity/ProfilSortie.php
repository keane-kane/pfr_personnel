<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilSortieRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ProfilSortieRepository::class)
 * @ApiResource(
 *      routePrefix= "admin",
 *      attributes = {
 *              "pagination_items_per_page" = 2,         
 *      },
 *      collectionOperations={
 *            "get"={
 *                "path"="/profilsorties"
 *              },
 *             "post"={
 *                "path"="/profilsorties"
 *              },
 *              "getPromoByProfileSortie" = { 
 *                  "path"="/promo/{id}/profilsorties",
 *                  "method" = "get"
 *              }
 *      },
 *      itemOperations= {
 *             "get"={
 *                "path"="/profilsorties/{id}"
 *              },
 *             "getApprenantByProfileSortieOnPromo" = { 
 *                  "path"="/promo/{id_p}/profilsorties/{id}",
 *                  "method"= "get"
 *              },
 *             "put"={
 *                "path"="/profilsorties/{id}"
 *              },
 *
 *       }
 * )
 */
class ProfilSortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le Libelle est obligatoire")
     */
    private $libelle;

      /**
     * @ORM\Column(type="boolean")
     */
    private $archive = 0;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="profilSortie")
     */
    private $profilsorti;

    /**
     * @ORM\ManyToMany(targetEntity=Promo::class, mappedBy="promoprofilsorti")
     */
    private $promos;

    public function __construct()
    {
        $this->profilsorti = new ArrayCollection();
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
     * @return Collection|Apprenant[]
     */
    public function getProfilsorti(): Collection
    {
        return $this->profilsorti;
    }

    public function addProfilsorti(Apprenant $profilsorti): self
    {
        if (!$this->profilsorti->contains($profilsorti)) {
            $this->profilsorti[] = $profilsorti;
            $profilsorti->setProfilSortie($this);
        }

        return $this;
    }

    public function removeProfilsorti(Apprenant $profilsorti): self
    {
        if ($this->profilsorti->removeElement($profilsorti)) {
            // set the owning side to null (unless already changed)
            if ($profilsorti->getProfilSortie() === $this) {
                $profilsorti->setProfilSortie(null);
            }
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
            $promo->addPromoprofilsorti($this);
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        if ($this->promos->removeElement($promo)) {
            $promo->removePromoprofilsorti($this);
        }

        return $this;
    }


}
