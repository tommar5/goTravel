<?php
namespace App\Entity\Location;

use App\Traits\Template\TemplateTrait;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class City
 * @package App\Entity\Location
 * @ORM\Entity(repositoryClass="App\Repository\Location\CityRepository")
 * @ORM\Table(name="city")
 */
class City
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
     * @var Collection|Airport[]
     * @ORM\OneToMany(targetEntity="Airport", mappedBy="city", cascade={"persist", "remove"})
     */
    private $airports;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

    public function __construct() {
        $this->airports = new ArrayCollection();
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
     * @return Collection|Airport[]
     */
    public function getAirports(): Collection
    {
        return $this->airports;
    }

    /**
     * @param Collection|Airport[] $airports
     */
    public function setAirports(array $airports): void
    {
        $this->airports = $airports;
    }

    /**
     * @param Airport $airport
     */
    public function addAirport(Airport $airport)
    {
        if (!$this->airports->contains($airport)) {
            $this->airports->add($airport);
            $airport->setCity($this);
        }
    }

    /**
     * @param Airport $airport
     */
    public function removeAirport(Airport $airport)
    {
        if ($this->airports->contains($airport)) {
            $this->airports->removeElement($airport);
        }
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry(Country $country): void
    {
        $this->country = $country;
    }
}