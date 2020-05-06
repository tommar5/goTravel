<?php
namespace App\Entity\Airline;

use App\Entity\Enquiry\Enquiry;
use App\Entity\Location\City;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Flight
 * @package App\Entity\Airline
 * @ORM\Entity(repositoryClass="App\Repository\Supplier\Flight\FlightRepository")
 * @ORM\Table(name="flight")
 */
class Flight
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
     * @var City
     * @ORM\OneToOne(targetEntity="App\Entity\Location\City")
     */
    private $origin;

    /**
     * @var City
     * @ORM\OneToOne(targetEntity="App\Entity\Location\City")
     */
    private $destination;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\NotBlank()
     */
    private $departureDate;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $returnDate;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=false)
     * @Assert\NotBlank()
     */
    private $price;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $class;

    /**
     * @var int|null
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var float|null
     * @ORM\Column(type="float", nullable=true)
     */
    private $distance;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=false, options={"default"=1})
     */
    private $isActive;

    /**
     * @var Collection|Enquiry[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Enquiry\Enquiry", mappedBy="flights")
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
     * @return City
     */
    public function getOrigin(): City
    {
        return $this->origin;
    }

    /**
     * @param City $origin
     */
    public function setOrigin(City $origin): void
    {
        $this->origin = $origin;
    }

    /**
     * @return City
     */
    public function getDestination(): City
    {
        return $this->destination;
    }

    /**
     * @param City $destination
     */
    public function setDestination(City $destination): void
    {
        $this->destination = $destination;
    }

    /**
     * @return \DateTime
     */
    public function getDepartureDate(): \DateTime
    {
        return $this->departureDate;
    }

    /**
     * @param \DateTime $departureDate
     */
    public function setDepartureDate(\DateTime $departureDate): void
    {
        $this->departureDate = $departureDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getReturnDate(): ?\DateTime
    {
        return $this->returnDate;
    }

    /**
     * @param \DateTime|null $returnDate
     */
    public function setReturnDate(?\DateTime $returnDate): void
    {
        $this->returnDate = $returnDate;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string|null
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @param string|null $class
     */
    public function setClass(?string $class): void
    {
        $this->class = $class;
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @param int|null $duration
     */
    public function setDuration(?int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return float|null
     */
    public function getDistance(): ?float
    {
        return $this->distance;
    }

    /**
     * @param float|null $distance
     */
    public function setDistance(?float $distance): void
    {
        $this->distance = $distance;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
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