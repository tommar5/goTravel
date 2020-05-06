<?php
namespace App\Entity\Location;

use App\Traits\Template\TemplateTrait;
use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Country
 * @package App\Entity\Location
 * @ORM\Entity(repositoryClass="App\Repository\Location\CountryRepository")
 * @ORM\Table(name="country")
 */
class Country
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
     * @var Collection|City[]
     * @ORM\OneToMany(targetEntity="City", mappedBy="country", cascade={"persist", "remove"})
     */
    private $cities;

    /**
     * @var Collection|Airport[]
     * @ORM\OneToMany(targetEntity="Airport", mappedBy="country", cascade={"persist", "remove"})
     */
    private $airports;

    public function __construct() {
        $this->cities = new ArrayCollection();
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
     * @return Collection|City[]
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    /**
     * @param Collection|City[] $cities
     */
    public function setCities(array $cities): void
    {
        $this->cities = $cities;
    }

    /**
     * @param City $city
     */
    public function addCity(City $city)
    {
        if (!$this->cities->contains($city)) {
            $this->cities->add($city);
            $city->setCountry($this);
        }
    }

    /**
     * @param City $city
     */
    public function removeCity(City $city)
    {
        if ($this->cities->contains($city)) {
            $this->cities->removeElement($city);
        }
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
            $airport->setCountry($this);
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
}