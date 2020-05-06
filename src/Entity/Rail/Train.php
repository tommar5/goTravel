<?php
namespace App\Entity\Rail;

use App\Entity\Enquiry\Enquiry;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Train
 * @package App\Entity\Rail
 * @ORM\Entity()
 * @ORM\Table(name="train")
 */
class Train
{
    use TimestampableTrait;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var Collection|Enquiry[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Enquiry\Enquiry", mappedBy="trains")
     */
    private $enquiries;

    public function __construct() {
        $this->enquiries = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
}