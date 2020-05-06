<?php
namespace App\Entity\Booking;

use App\Entity\Quote\Quote;
use App\Entity\Traveller\Traveller;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Booking
 * @package App\Entity\Booking
 * @ORM\Entity(repositoryClass="App\Repository\Booking\BookingRepository")
 * @ORM\Table(name="booking")
 */
class Booking
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
     * @var Traveller
     * @ORM\ManyToOne(targetEntity="App\Entity\Traveller\Traveller", inversedBy="bookings")
     * @ORM\JoinColumn(name="lead_id", referencedColumnName="id")
     */
    private $lead;

    /**
     * @var Collection|Traveller[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Traveller\Traveller", mappedBy="passengerOfBookings")
     */
    private $travellers;

    /**
     * @var Quote
     * @ORM\ManyToOne(targetEntity="App\Entity\Quote\Quote", inversedBy="bookings")
     * @ORM\JoinColumn(name="quote_id", referencedColumnName="id")
     */
    private $quote;

    public function __construct()
    {
        $this->travellers = new ArrayCollection();
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
    public function getLead(): Traveller
    {
        return $this->lead;
    }

    /**
     * @param Traveller $lead
     */
    public function setLead(Traveller $lead): void
    {
        $this->lead = $lead;
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
     * @var Traveller $traveller
     */
    public function addTraveller(Traveller $traveller)
    {
        if (!$this->travellers->contains($traveller)) {
            $this->travellers->add($traveller);
            $traveller->addPassengerOfBooking($this);
        }
    }

    /**
     * @param Traveller $traveller
     */
    public function removeTraveller(Traveller $traveller)
    {
        if ($this->travellers->contains($traveller)) {
            $this->travellers->removeElement($traveller);
        }
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
}