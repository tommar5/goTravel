<?php
namespace App\Entity;

use App\Entity\Enquiry\Enquiry;
use App\Entity\Quote\Quote;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\User\UserRepository")
 * @UniqueEntity(fields="email", message="Email already taken")
 */
class User implements UserInterface
{
    use TimestampableTrait;

    public const roleMap = [
        0 => 'ROLE_USER',
        1 => 'ROLE_CONSULTANT',
        2 => 'ROLE_ACCOUNTANT',
        3 => 'ROLE_ADMIN',
        4 => 'ROLE_SUPER_ADMIN',
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     * @Assert\NotBlank()
     */
    private $secondName;

    /**
     * @Assert\Length(max=16)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @var Collection|Enquiry[]
     * @ORM\OneToMany(targetEntity="App\Entity\Enquiry\Enquiry", mappedBy="consultant")
     */
    private $enquiries;

    /**
     * @var Collection|Quote[]
     * @ORM\OneToMany(targetEntity="App\Entity\Quote\Quote", mappedBy="consultant")
     */
    private $quotes;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default"=1})
     */
    private $isActive;

    public function __construct()
    {
        $this->enquiries = new ArrayCollection();
        $this->quotes = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getUserFullName()
    {
        return $this->firstName . ' ' . $this->secondName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getSecondName()
    {
        return $this->secondName;
    }

    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        return null;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getUserRoles()
    {
        $roles = '';
        foreach ($this->roles as $role) {
            $roles = $roles . $role . ', ';
        }

        return $roles;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return Enquiry[]|Collection
     */
    public function getEnquiries()
    {
        return $this->enquiries;
    }

    /**
     * @param Enquiry[]|Collection $enquiries
     */
    public function setEnquiries($enquiries): void
    {
        $this->enquiries = $enquiries;
    }

    /**
     * @param Enquiry $enquiry
     */
    public function addEnquiry(Enquiry $enquiry)
    {
        if (!$this->enquiries->contains($enquiry)) {
            $this->enquiries->add($enquiry);
        }
    }

    /**
     * @param Enquiry $enquiry
     */
    public function removeEnquiry(Enquiry $enquiry)
    {
        if ($this->enquiries->contains($enquiry)) {
            $this->enquiries->removeElement($enquiry);
        }
    }

    /**
     * @return Quote[]|Collection
     */
    public function getQuotes()
    {
        return $this->quotes;
    }

    /**
     * @param Quote[]|Collection $quotes
     */
    public function setQuotes($quotes): void
    {
        $this->quotes = $quotes;
    }

    /**
     * @param Quote $quote
     */
    public function addQuote(Quote $quote)
    {
        if (!$this->quotes->contains($quote)) {
            $this->quotes->add($quote);
            $quote->setConsultant($this);
        }
    }

    /**
     * @param Quote $quote
     */
    public function removeQuote(Quote $quote)
    {
        if ($this->quotes->contains($quote)) {
            $this->quotes->removeElement($quote);
        }
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }
}