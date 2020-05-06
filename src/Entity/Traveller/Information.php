<?php
namespace App\Entity\Traveller;

use App\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Information
 * @package App\Entity\Traveller
 * @ORM\Entity(repositoryClass="App\Repository\Traveller\InformationRepository")
 * @ORM\Table(name="traveller_information")
 */
class Information
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
     * @ORM\OneToOne(targetEntity="Traveller", inversedBy="information")
     * @ORM\JoinColumn(name="traveller_id", referencedColumnName="id")
     */
    private $traveller;

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
    public function getTraveller()
    {
        return $this->traveller;
    }

    /**
     * @param mixed $traveller
     */
    public function setTraveller($traveller): void
    {
        $this->traveller = $traveller;
    }
}