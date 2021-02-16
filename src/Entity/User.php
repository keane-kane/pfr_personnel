<?php

namespace App\Entity;

use App\Entity\Profile;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\JoinColumn;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="profile", type="string")
 * @ORM\DiscriminatorMap(
 *      {"user" = "User", "apprenant" = "Apprenant", "admin"="Admin", "formateur"="Formateur", " cm"="Cm"}
 *  )
 * @ApiFilter(BooleanFilter::class, properties={"archive"=false})
 * @ApiResource(
 *  
 *      normalizationContext   ={"groups"={"users:read"}},
 *      attributes={
 *          "pagination_items_per_page"=30,
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "security_message"="Acces refusé vous n'avez pas l'autorisation"
 *     },
 *     collectionOperations={
 *          "get"={
 *                "path"="/users",
 *                "method"="get"
 *              },  
 *           "post"={
 *                "path"="/users",
 *                "method"="post"
 *              }, 
 *        
 *      },
 *     itemOperations={
 *         "GET"={
 *              "path"="/users/{id}"
 *            },
 *         "PUT"={
 *             "path"="/users/{id}"
 *          },
 *        "DELETE"={
 *             "path"="/users/{id}"
 *          },
 *        
 *  }
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"users:read", "profil:read"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=false)
     * @Assert\NotBlank(message="Le Libelle est obligatoire")
     * @Groups({"users:read","profil:read"})
     */
    protected $username;

    protected $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le Libelle est obligatoire")
     */
    protected $password;
    
    /**
     * A non-persisted field that's used to create the encoded password.
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users:read","profil:read"})
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users:read","profil:read"})
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users:read","profil:read"})
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     * @Groups({"users:read","profil:read"})
     */
    protected $phone;

    /**
     * @ORM\Column(type="blob", nullable =true)
     * @Groups({"users:read","profil:read"})
     */
    protected $avatar;

    /**
     * @ORM\ManyToOne(targetEntity=Profile::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"users:read","profil:read"})
     */
    protected $profil;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"users:read","profil:read"})
     */
    protected $archive=false;


 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        // forces the object to look "dirty" to Doctrine. Avoids
        // Doctrine *not* saving this entity, if only plainPassword changes
        $this->password = null;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAvatar()
    {   
        if($this->avatar != null){
            $avatar = @stream_get_contents($this->avatar);
            @fclose($this->avatar);
            return base64_encode($avatar);
        }
        return;    
    }

    public function setAvatar($avatar): self
    {

        $this->avatar = $avatar;

        return $this;
    }

    public function getProfil(): ?profile
    {
        return $this->profil;
    }

    public function setProfil(?profile $profil): self
    {
        $this->profil = $profil;

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
}
