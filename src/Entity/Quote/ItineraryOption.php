<?php
namespace App\Entity\Quote;

use App\Entity\Accommodation\Hotel;
use App\Entity\Airline\Flight;
use App\Entity\Cruise\Cruise;
use App\Entity\Holiday\Holiday;
use App\Entity\Rail\Train;
use App\Traits\SortableTrait;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ItineraryOption
 * @package App\Entity\Quote
 * @ORM\Entity()
 * @ORM\Table(name="quote_itinerary_option")
 */
class ItineraryOption
{
    use TimestampableTrait, SortableTrait;

    const TYPE_FLIGHT = 'flight';
    const TYPE_HOTEL = 'hotel';
    const TYPE_RAIL = 'rail';
    const TYPE_CRUISE = 'cruise';
    const TYPE_HOLIDAY = 'holiday';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Quote
     * @ORM\ManyToOne(targetEntity="Quote", inversedBy="itineraryOptions")
     * @ORM\JoinColumn(name="quote_id", referencedColumnName="id")
     * @ORM\OrderBy({"sortOrder" = "ASC"})
     */
    private $quote;

    /**
     * @ORM\Column(name="total_price", type="decimal", precision=16, scale=2, nullable=true)
     */
    private $totalPrice;

    /**
     * @ORM\Column(type="decimal", precision=16, scale=2, nullable=true)
     */
    private $pricePerAdult;

    /**
     * @ORM\Column(type="decimal", precision=16, scale=2, nullable=true)
     */
    private $pricePerYoungAdult;

    /**
     * @ORM\Column(type="decimal", precision=16, scale=2, nullable=true)
     */
    private $pricePerChild;

    /**
     * @ORM\Column(type="decimal", precision=16, scale=2, nullable=true)
     */
    private $pricePerInfant;

    /**
     * @ORM\Column(type="decimal", precision=16, scale=2, nullable=true)
     */
    private $changeFee;

    /**
     * @ORM\Column(length=32, nullable=true)
     */
    private $type = self::TYPE_FLIGHT;

    /**
     * @var ArrayCollection|Flight[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Airline\Flight", inversedBy="quoteItineraries")
     * @ORM\JoinTable(name="quote_itinerary_options_flights")
     */
    private $flights;

    /**
     * @var ArrayCollection|Hotel[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Accommodation\Hotel", inversedBy="quoteItineraries")
     * @ORM\JoinTable(name="quote_itinerary_options_hotels")
     */
    private $hotels;

    /**
     * @var ArrayCollection|Train[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Rail\Train", inversedBy="quoteItineraries")
     * @ORM\JoinTable(name="quote_itinerary_options_trains")
     */
    private $trains;

    /**
     * @var ArrayCollection|Cruise[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Cruise\Cruise", inversedBy="quoteItineraries")
     * @ORM\JoinTable(name="quote_itinerary_options_cruises")
     */
    private $cruises;

    /**
     * @var Holiday
     * @ORM\ManyToOne(targetEntity="App\Entity\Holiday\Holiday", inversedBy="quoteItineraries")
     * @ORM\JoinColumn(name="holiday_id", referencedColumnName="id")
     */
    private $holiday;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=false, options={"default"=0})
     */
    private $isConfirmed;

    public function __construct() {
        $this->flights = new ArrayCollection();
        $this->hotels = new ArrayCollection();
        $this->trains = new ArrayCollection();
        $this->trains = new ArrayCollection();
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

    /**
     * @return Quote
     */
    public function getQuote(): Quote
    {
        return $this->quote;
    }

    /**
     * @param Quote $quote
     */
    public function setQuote(Quote $quote): void
    {
        $this->quote = $quote;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return mixed
     */
    public function getPricePerAdult()
    {
        return $this->pricePerAdult;
    }

    /**
     * @param mixed $pricePerAdult
     */
    public function setPricePerAdult($pricePerAdult): void
    {
        $this->pricePerAdult = $pricePerAdult;
    }

    /**
     * @return mixed
     */
    public function getPricePerYoungAdult()
    {
        return $this->pricePerYoungAdult;
    }

    /**
     * @param mixed $pricePerYoungAdult
     */
    public function setPricePerYoungAdult($pricePerYoungAdult): void
    {
        $this->pricePerYoungAdult = $pricePerYoungAdult;
    }

    /**
     * @return mixed
     */
    public function getPricePerChild()
    {
        return $this->pricePerChild;
    }

    /**
     * @param mixed $pricePerChild
     */
    public function setPricePerChild($pricePerChild): void
    {
        $this->pricePerChild = $pricePerChild;
    }

    /**
     * @return mixed
     */
    public function getPricePerInfant()
    {
        return $this->pricePerInfant;
    }

    /**
     * @param mixed $pricePerInfant
     */
    public function setPricePerInfant($pricePerInfant): void
    {
        $this->pricePerInfant = $pricePerInfant;
    }

    /**
     * @return mixed
     */
    public function getChangeFee()
    {
        return $this->changeFee;
    }

    /**
     * @param mixed $changeFee
     */
    public function setChangeFee($changeFee): void
    {
        $this->changeFee = $changeFee;
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
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    /**
     * @param bool $isConfirmed
     */
    public function setIsConfirmed(bool $isConfirmed): void
    {
        $this->isConfirmed = $isConfirmed;
    }
}