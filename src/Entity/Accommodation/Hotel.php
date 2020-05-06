<?php
namespace App\Entity\Accommodation;

use App\Entity\Enquiry\Enquiry;
use App\Traits\Template\ImageTrait;
use App\Traits\Template\TemplateTrait;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Hotel
 * @package App\Entity\Accommodation
 * @ORM\Entity(repositoryClass="App\Repository\Supplier\Accommodation\HotelRepository")
 * @ORM\Table(name="hotel")
 */
class Hotel
{
    use TimestampableTrait, TemplateTrait, ImageTrait;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(length=128, nullable=false)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var Collection|Room[]
     * @ORM\OneToMany(targetEntity="Room", mappedBy="hotel", cascade={"persist", "remove"})
     */
    private $rooms;

    /**
     * @var Collection|Enquiry[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Enquiry\Enquiry", mappedBy="hotels")
     */
    private $enquiries;

    public function __construct()
    {
        $this->rooms =  new ArrayCollection();
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Room[]|Collection
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @param Room[]|Collection $rooms
     */
    public function setRooms($rooms): void
    {
        $this->rooms = $rooms;
    }

    /**
     * @param Room $room
     */
    public function addRoom(Room $room)
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms->add($room);
            $room->setHotel($this);
        }
    }

    /**
     * @param Room $room
     */
    public function removeRoom(Room $room)
    {
        if ($this->rooms->contains($room)) {
            $this->rooms->removeElement($room);
        }
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