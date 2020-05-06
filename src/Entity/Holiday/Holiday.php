<?php
namespace App\Entity\Holiday;

use App\Entity\Enquiry\Enquiry;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Holiday
 * @package App\Entity\Holiday
 * @ORM\Entity(repositoryClass="App\Repository\Supplier\Holiday\HolidayRepository")
 * @ORM\Table(name="holiday")
 */
class Holiday
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
     * @ORM\OneToMany(targetEntity="App\Entity\Enquiry\Enquiry", mappedBy="holiday")
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