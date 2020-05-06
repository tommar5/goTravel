<?php
namespace App\Entity\Quote;

use App\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CallReminder
 * @package App\Entity\Quote
 * @ORM\Entity()
 * @ORM\Table(name="quote_call_reminder")
 */
class CallReminder
{
    use TimestampableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Quote
     * @ORM\ManyToOne(targetEntity="Quote", inversedBy="callReminders")
     */
    private $quote;

    /**
     * @ORM\Column(nullable=false)
     * @Assert\NotBlank()
     */
    private $note;

    /**
     * @var \DateTime
     * @ORM\Column(name="time", type="datetime", nullable=false)
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $time;

    /**
     * @return Int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Quote
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * @param Quote $quote
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }
}