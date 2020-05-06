<?php
namespace App\Entity\Enquiry;

use App\Entity\Accommodation\Hotel;
use App\Entity\Airline\Flight;
use App\Entity\Cruise\Cruise;
use App\Entity\Holiday\Holiday;
use App\Entity\Rail\Train;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Enquiry
 * @package App\Entity\Enquiry
 * @ORM\Entity(repositoryClass="App\Repository\Enquiry\EnquiryRepository")
 * @ORM\Table(name="enquiry")
 */
class Enquiry
{
    use TimestampableTrait;

    const STATUS_SUBMITTED = 'submitted';
    const STATUS_ASSIGNED = 'assigned';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CLOSED = 'closed';

    const TYPE_PHONE = 'phone';
    const TYPE_FLIGHT = 'flight';
    const TYPE_HOTEL = 'hotel';
    const TYPE_TRAIN = 'train';
    const TYPE_HOLIDAY = 'holiday';
    const TYPE_CRUISE = 'cruise';

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="enquiries")
     * @ORM\JoinColumn(name="consultant_id", referencedColumnName="id")
     */
    private $consultant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Traveller\Traveller", inversedBy="enquiries")
     * @ORM\JoinColumn(name="traveller_id", referencedColumnName="id")
     */
    private $existingTraveller;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeparture;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $adults;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $youngAdults;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $children;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $infants;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *      max = 250,
     *      maxMessage = "Your message cannot be longer than {{ limit }} characters"
     * )
     */
    private $additionalRequirements;

    /**
     * @ORM\Column(length=64, nullable=false, options={"default"="submitted"})
     */
    private $status = self::STATUS_SUBMITTED;

    /**
     * @ORM\Column(length=64, nullable=false, options={"default"="phone"})
     */
    private $type = self::TYPE_PHONE;

    /**
     * @var ArrayCollection|Flight[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Airline\Flight", inversedBy="enquiries")
     * @ORM\JoinTable(name="enquiries_flights")
     */
    private $flights;

    /**
     * @var ArrayCollection|Hotel[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Accommodation\Hotel", inversedBy="enquiries")
     * @ORM\JoinTable(name="enquiries_hotels")
     */
    private $hotels;

    /**
     * @var ArrayCollection|Train[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Rail\Train", inversedBy="enquiries")
     * @ORM\JoinTable(name="enquiries_trains")
     */
    private $trains;

    /**
     * @var ArrayCollection|Cruise[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Cruise\Cruise", inversedBy="enquiries")
     * @ORM\JoinTable(name="enquiries_cruises")
     */
    private $cruises;

    /**
     * @var Holiday
     * @ORM\ManyToOne(targetEntity="App\Entity\Holiday\Holiday", inversedBy="enquiries")
     * @ORM\JoinColumn(name="holiday_id", referencedColumnName="id")
     */
    private $holiday;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default"=0})
     */
    private $marketingConsent = 0;

    public function __construct() {
        $this->flights = new ArrayCollection();
        $this->hotels = new ArrayCollection();
        $this->trains = new ArrayCollection();
        $this->trains = new ArrayCollection();
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
     * @return mixed
     */
    public function getConsultant()
    {
        return $this->consultant;
    }

    /**
     * @param mixed $consultant
     */
    public function setConsultant($consultant): void
    {
        $this->consultant = $consultant;
    }

    /**
     * @return mixed
     */
    public function getExistingTraveller()
    {
        return $this->existingTraveller;
    }

    /**
     * @param mixed $existingTraveller
     */
    public function setExistingTraveller($existingTraveller): void
    {
        $this->existingTraveller = $existingTraveller;
    }

    /**
     * @return mixed
     */
    public function getDateDeparture()
    {
        return $this->dateDeparture;
    }

    /**
     * @param mixed $dateDeparture
     */
    public function setDateDeparture($dateDeparture): void
    {
        $this->dateDeparture = $dateDeparture;
    }

    /**
     * @return mixed
     */
    public function getAdults()
    {
        return $this->adults;
    }

    /**
     * @param mixed $adults
     */
    public function setAdults($adults): void
    {
        $this->adults = $adults;
    }

    /**
     * @return mixed
     */
    public function getYoungAdults()
    {
        return $this->youngAdults;
    }

    /**
     * @param mixed $youngAdults
     */
    public function setYoungAdults($youngAdults): void
    {
        $this->youngAdults = $youngAdults;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children): void
    {
        $this->children = $children;
    }

    /**
     * @return mixed
     */
    public function getInfants()
    {
        return $this->infants;
    }

    /**
     * @param mixed $infants
     */
    public function setInfants($infants): void
    {
        $this->infants = $infants;
    }

    /**
     * @return mixed
     */
    public function getAdditionalRequirements()
    {
        return $this->additionalRequirements;
    }

    /**
     * @param mixed $additionalRequirements
     */
    public function setAdditionalRequirements($additionalRequirements): void
    {
        $this->additionalRequirements = $additionalRequirements;
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
     * @return ArrayCollection
     */
    public function getFlights(): ArrayCollection
    {
        return $this->flights;
    }

    /**
     * @param ArrayCollection $flights
     */
    public function setFlights(ArrayCollection $flights): void
    {
        $this->flights = $flights;
    }

    /**
     * @param Flight $flight
     */
    public function addFlight(Flight $flight)
    {
        if (!$this->flights->contains($flight)) {
            $this->flights->add($flight);
        }
    }

    /**
     * @param Flight $flight
     */
    public function removeFlight(Flight $flight)
    {
        if ($this->flights->contains($flight)) {
            $this->flights->removeElement($flight);
        }
    }

    /**
     * @return mixed
     */
    public function getHotels()
    {
        return $this->hotels;
    }

    /**
     * @param mixed $hotels
     */
    public function setHotels($hotels): void
    {
        $this->hotels = $hotels;
    }

    /**
     * @param Hotel $hotel
     */
    public function addHotel(Hotel $hotel)
    {
        if (!$this->hotels->contains($hotel)) {
            $this->hotels->add($hotel);
        }
    }

    /**
     * @param Hotel $hotel
     */
    public function removeHotel(Hotel $hotel)
    {
        if ($this->hotels->contains($hotel)) {
            $this->hotels->removeElement($hotel);
        }
    }

    /**
     * @return mixed
     */
    public function getTrains()
    {
        return $this->trains;
    }

    /**
     * @param mixed $trains
     */
    public function setTrains($trains): void
    {
        $this->trains = $trains;
    }

    /**
     * @param Train $train
     */
    public function addTrain(Train $train)
    {
        if (!$this->trains->contains($train)) {
            $this->trains->add($train);
        }
    }

    /**
     * @param Train $train
     */
    public function removeTrain(Train $train)
    {
        if ($this->trains->contains($train)) {
            $this->trains->removeElement($train);
        }
    }

    /**
     * @return mixed
     */
    public function getCruises()
    {
        return $this->cruises;
    }

    /**
     * @param mixed $cruises
     */
    public function setCruises($cruises): void
    {
        $this->cruises = $cruises;
    }

    /**
     * @param Cruise $cruise
     */
    public function addCruise(Cruise $cruise)
    {
        if (!$this->cruises->contains($cruise)) {
            $this->cruises->add($cruise);
        }
    }

    /**
     * @param Cruise $cruise
     */
    public function removeCruise(Cruise $cruise)
    {
        if ($this->cruises->contains($cruise)) {
            $this->cruises->removeElement($cruise);
        }
    }

    /**
     * @return mixed
     */
    public function getHoliday()
    {
        return $this->holiday;
    }

    /**
     * @param Holiday $holiday
     */
    public function setHoliday(Holiday $holiday): void
    {
        $this->holiday = $holiday;
    }

    /**
     * @return int
     */
    public function getMarketingConsent(): int
    {
        return $this->marketingConsent;
    }

    /**
     * @param int $marketingConsent
     */
    public function setMarketingConsent(int $marketingConsent): void
    {
        $this->marketingConsent = $marketingConsent;
    }
}