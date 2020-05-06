<?php
namespace App\Entity\Location;

use App\Traits\Template\TemplateTrait;
use App\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Airport
 * @package App\Entity\Location
 * @ORM\Entity(repositoryClass="App\Repository\Location\AirportRepository")
 * @ORM\Table(name="airport")
 */
class Airport
{
    use TimestampableTrait, TemplateTrait;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(length=8, nullable=false, unique=true)
     * @Assert\NotBlank()
     */
    private $code;

    /**
     * @var string
     * @ORM\Column(length=128, nullable=false)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(length=16, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     * @ORM\Column(length=16, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     * @ORM\Column(length=32, nullable=true)
     */
    private $timeZone;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=false, options={"default"=1})
     */
    private $flightable;

    /**
     * @var City
     * @ORM\ManyToOne(targetEntity="City", inversedBy="airports")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="airports")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

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
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
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
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude|null
     */
    public function setLatitude(string $latitude = null): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude|null
     */
    public function setLongitude(string $longitude = null): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getTimeZone(): string
    {
        return $this->timeZone;
    }

    /**
     * @param string $timeZone|null
     */
    public function setTimeZone(string $timeZone = null): void
    {
        $this->timeZone = $timeZone;
    }

    /**
     * @return bool
     */
    public function isFlightable(): bool
    {
        return $this->flightable;
    }

    /**
     * @param bool $flightable
     */
    public function setFlightable(bool $flightable): void
    {
        $this->flightable = $flightable;
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @param City $city|null
     */
    public function setCity(City $city = null): void
    {
        $this->city = $city;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @param Country $country|null
     */
    public function setCountry(Country $country = null): void
    {
        $this->country = $country;
    }

}