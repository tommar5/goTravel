<?php
namespace App\Entity\Airline;

use App\Traits\Template\ImageTrait;
use App\Traits\Template\TemplateTrait;
use App\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Airline
 * @package App\Entity\Airline
 * @ORM\Entity(repositoryClass="App\Repository\Supplier\Flight\AirlineRepository")
 * @ORM\Table(name="airline")
 */
class Airline
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
     * @var string|null
     * @ORM\Column(length=128, nullable=true)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(length=128, nullable=true)
     */
    private $alias;

    /**
     * @var string
     * @ORM\Column(length=8, nullable=false, unique=true)
     * @Assert\NotBlank()
     */
    private $iata;

    /**
     * @var string|null
     * @ORM\Column(length=8, nullable=true)
     */
    private $icao;

    /**
     * @var string|null
     * @ORM\Column(length=128, nullable=true)
     */
    private $callSign;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default"=0})
     */
    private $isActive = 0;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default"=0})
     */
    private $lowCostCarrier = 0;

    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     */
    private $url;

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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @param string|null $alias
     */
    public function setAlias(?string $alias): void
    {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getIata(): string
    {
        return $this->iata;
    }

    /**
     * @param string $iata
     */
    public function setIata(string $iata): void
    {
        $this->iata = $iata;
    }

    /**
     * @return string|null
     */
    public function getIcao(): ?string
    {
        return $this->icao;
    }

    /**
     * @param string|null $icao
     */
    public function setIcao(?string $icao): void
    {
        $this->icao = $icao;
    }

    /**
     * @return string|null
     */
    public function getCallSign(): ?string
    {
        return $this->callSign;
    }

    /**
     * @param string|null $callSign
     */
    public function setCallSign(?string $callSign): void
    {
        $this->callSign = $callSign;
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
     * @return bool
     */
    public function isLowCostCarrier(): bool
    {
        return $this->lowCostCarrier;
    }

    /**
     * @param bool $lowCostCarrier
     */
    public function setLowCostCarrier(bool $lowCostCarrier): void
    {
        $this->lowCostCarrier = $lowCostCarrier;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
}