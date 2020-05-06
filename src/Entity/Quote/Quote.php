<?php
namespace App\Entity\Quote;

use App\Entity\Booking\Booking;
use App\Entity\Traveller\Traveller;
use App\Entity\User;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Quote
 * @package App\Entity\Quote
 * @ORM\Entity(repositoryClass="App\Repository\Quote\QuoteRepository")
 * @ORM\Table(name="quote")
 */
class Quote
{
    use TimestampableTrait;

    const STATUS_CREATED = 'created';
    const STATUS_QUOTE_SENT = 'quote sent';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CLOSED = 'closed';

    const TYPE_FLIGHT = 'flight';
    const TYPE_HOTEL = 'hotel';
    const TYPE_RAIL = 'rail';
    const TYPE_HOLIDAY = 'holiday';
    const TYPE_CRUISE = 'cruise';

    const TRAVEL_TYPE_BUSINESS = 'business';
    const TRAVEL_TYPE_LEISURE = 'leisure';

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="quotes")
     * @ORM\JoinColumn(name="cosultant_id", referencedColumnName="id", nullable=true)
     */
    private $consultant;

    /**
     * @var \DateTime
     * @ORM\Column(name="assigned_at", type="datetime", nullable=true)
     */
    private $assignedAt;

    /**
     * @ORM\Column(length=64, nullable=false, options={"default"="created"})
     */
    private $status = self::STATUS_CREATED;

    /**
     * @ORM\Column(length=64, nullable=false, options={"default"="flight"})
     */
    private $type = self::TYPE_FLIGHT;

    /**
     * @var Traveller
     * @ORM\ManyToOne(targetEntity="App\Entity\Traveller\Traveller", inversedBy="quotes")
     * @ORM\JoinColumn(name="traveller_id", referencedColumnName="id")
     */
    private $traveller;

    /**
     * @var \DateTime
     * @ORM\Column(name="quote_sent_at", type="datetime", nullable=true)
     */
    private $quoteSentAt;

    /**
     * @var Collection|ItineraryOption[]
     * @ORM\OneToMany(targetEntity="App\Entity\Quote\ItineraryOption", mappedBy="quote", cascade={"persist", "remove"})
     * @ORM\OrderBy({"sortOrder" = "ASC"})
     */
    private $itineraryOptions;

    /**
     * @var Collection|EmailHistory[]
     * @ORM\OneToMany(targetEntity="App\Entity\Quote\EmailHistory", mappedBy="quote", cascade={"persist", "remove"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $emailHistories;

    /**
     * @var Collection|CallReminder[]
     * @ORM\OneToMany(targetEntity="App\Entity\Quote\CallReminder", mappedBy="quote", cascade={"persist", "remove"})
     * @ORM\OrderBy({"time" = "ASC"})
     */
    private $callReminders;

    /**
     * @var Collection|Traveller[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Traveller\Traveller", inversedBy="additionalQuotes", cascade={"persist"})
     * @ORM\JoinTable(name="quotes_travellers")
     */
    private $travellers;

    /**
     * @ORM\Column(nullable=false, options={"default"="leisure"})
     */
    private $travelType = self::TRAVEL_TYPE_LEISURE;

    /**
     * @ORM\Column(options={"default"="lead"})
     */
    private $userType;

    /**
     * @var Collection|Booking[]
     * @ORM\OneToMany(targetEntity="App\Entity\Booking\Booking", mappedBy="quote", cascade={"persist"})
     */
    private $bookings;

    public function __construct()
    {
        $this->itineraryOptions = new ArrayCollection();
        $this->travellers = new ArrayCollection();
        $this->emailHistories = new ArrayCollection();
        $this->callReminders = new ArrayCollection();
        $this->bookings = new ArrayCollection();
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
     * @return Traveller
     */
    public function getTraveller(): Traveller
    {
        return $this->traveller;
    }

    /**
     * @param Traveller $traveller
     */
    public function setTraveller(Traveller $traveller): void
    {
        $this->traveller = $traveller;
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

    /**
     * @param Booking $booking
     */
    public function addBooking(Booking $booking)
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setQuote($this);
        }
    }

    /**
     * @param Booking $booking
     */
    public function removeBooking(Booking $booking)
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
        }
    }

    /**
     * @return User
     */
    public function getConsultant(): User
    {
        return $this->consultant;
    }

    /**
     * @param User $consultant
     */
    public function setConsultant(User $consultant): void
    {
        $this->consultant = $consultant;
    }

    /**
     * @return \DateTime
     */
    public function getAssignedAt(): \DateTime
    {
        return $this->assignedAt;
    }

    /**
     * @param \DateTime $assignedAt
     */
    public function setAssignedAt(\DateTime $assignedAt): void
    {
        $this->assignedAt = $assignedAt;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return \DateTime
     */
    public function getQuoteSentAt(): \DateTime
    {
        return $this->quoteSentAt;
    }

    /**
     * @param \DateTime $quoteSentAt
     */
    public function setQuoteSentAt(\DateTime $quoteSentAt): void
    {
        $this->quoteSentAt = $quoteSentAt;
    }

    /**
     * @return ItineraryOption[]|Collection
     */
    public function getItineraryOptions()
    {
        return $this->itineraryOptions;
    }

    /**
     * @param ItineraryOption[]|Collection $itineraryOptions
     */
    public function setItineraryOptions($itineraryOptions): void
    {
        $this->itineraryOptions = $itineraryOptions;
    }

    /**
     * @return EmailHistory[]|Collection
     */
    public function getEmailHistories()
    {
        return $this->emailHistories;
    }

    /**
     * @param EmailHistory[]|Collection $emailHistories
     */
    public function setEmailHistories($emailHistories): void
    {
        $this->emailHistories = $emailHistories;
    }

    /**
     * @return CallReminder[]|Collection
     */
    public function getCallReminders()
    {
        return $this->callReminders;
    }

    /**
     * @param CallReminder[]|Collection $callReminders
     */
    public function setCallReminders($callReminders): void
    {
        $this->callReminders = $callReminders;
    }

    /**
     * @return Traveller[]|Collection
     */
    public function getTravellers()
    {
        return $this->travellers;
    }

    /**
     * @param Traveller[]|Collection $travellers
     */
    public function setTravellers($travellers): void
    {
        $this->travellers = $travellers;
    }

    /**
     * @return string
     */
    public function getTravelType(): string
    {
        return $this->travelType;
    }

    /**
     * @param string $travelType
     */
    public function setTravelType(string $travelType): void
    {
        $this->travelType = $travelType;
    }

    /**
     * @return mixed
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * @param mixed $userType
     */
    public function setUserType($userType): void
    {
        $this->userType = $userType;
    }
}