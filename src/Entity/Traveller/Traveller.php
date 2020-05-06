<?php
namespace App\Entity\Traveller;

use App\Entity\Booking\Booking;
use App\Entity\Enquiry\Enquiry;
use App\Entity\Quote\Quote;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Traveller
 * @package App\Entity\Traveller
 * @ORM\Entity(repositoryClass="App\Repository\Traveller\TravellerRepository")
 * @ORM\Table(name="traveller")
 */
class Traveller
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
     * @var string
     * @ORM\Column(length=16, nullable=false)
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(length=32, nullable=false)
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @var Collection|Booking[]
     * @ORM\OneToMany(targetEntity="App\Entity\Booking\Booking", mappedBy="lead", cascade={"persist"})
     */
    private $bookings;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Booking\Booking", inversedBy="travellers")
     * @ORM\JoinTable(name="travelers_bookings")
     */
    private $passengerOfBookings;

    /**
     * @var Collection|Enquiry[]
     * @ORM\OneToMany(targetEntity="App\Entity\Enquiry\Enquiry", mappedBy="existingTraveller", cascade={"persist"})
     */
    private $enquiries;

    /**
     * Traveler quotes where we is a lead of travel.
     * @var Collection|Quote[]
     * @ORM\OneToMany(targetEntity="App\Entity\Quote\Quote", mappedBy="traveller", cascade={"persist"})
     */
    private $quotes;

    /**
     * Quotes in which traveller is as additional traveller.
     * @var Collection|Quote[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Quote\Quote", mappedBy="travellers", cascade={"persist"})
     */
    private $additionalQuotes;

    /**
     * @ORM\OneToOne(targetEntity="Information", mappedBy="traveller")
     */
    private $information;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->enquiries = new ArrayCollection();
        $this->passengerOfBookings = new ArrayCollection();
        $this->quotes = new ArrayCollection();
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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @return Booking[]|Collection
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @param Booking[]|Collection $bookings
     */
    public function setBookings($bookings): void
    {
        $this->bookings = $bookings;
    }

    public function addBooking(Booking $booking)
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setLead($this);
        }
    }

    public function removeBooking(Booking $booking)
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getPassengerOfBookings(): ArrayCollection
    {
        return $this->passengerOfBookings;
    }

    /**
     * @param ArrayCollection $passengerOfBookings
     */
    public function setPassengerOfBookings(ArrayCollection $passengerOfBookings): void
    {
        $this->passengerOfBookings = $passengerOfBookings;
    }

    /**
     * @param Booking $booking
     */
    public function addPassengerOfBooking(Booking $booking)
    {
        if (!$this->passengerOfBookings->contains($booking)) {
            $this->passengerOfBookings->add($booking);
        }
    }

    /**
     * @param Booking $booking
     */
    public function removePassengerOfBooking(Booking $booking)
    {
        if ($this->passengerOfBookings->contains($booking)) {
            $this->passengerOfBookings->removeElement($booking);
        }
    }

    /**
     * @return Collection|Enquiry[]
     */
    public function getEnquiries()
    {
        return $this->enquiries;
    }

    /**
     * @param Collection|Enquiry[] $enquiries
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
            $enquiry->setExistingTraveller($this);
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
     * @return Collection|Quote[]
     */
    public function getQuotes()
    {
        return $this->quotes;
    }

    /**
     * @param Collection|Quote[] $quotes
     */
    public function setQuotes($quotes): void
    {
        $this->quotes = $quotes;
    }

    public function addQuote(Quote $quote)
    {

    }

    public function removeQuote(Quote $quote)
    {

    }

    /**
     * @return mixed
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param mixed $information
     */
    public function setInformation($information): void
    {
        $this->information = $information;
    }
}