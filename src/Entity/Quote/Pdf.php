<?php
namespace App\Entity\Quote;

use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="quote_pdf")
 */
class Pdf
{
    use TimestampableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Quote", inversedBy="pdfs")
     * @ORM\JoinColumn(name="quote_id", referencedColumnName="id")
     */
    private $quote;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Quote\EmailHistory", mappedBy="pdfs")
     */
    private $emailHistories;

    /**
     * @ORM\Column()
     */
    private $filename;

    public function __construct()
    {
        $this->emailHistories = new ArrayCollection();
    }

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
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return mixed
     */
    public function getEmailHistories()
    {
        return $this->emailHistories;
    }

    /**
     * @param mixed $emailHistories
     */
    public function setEmailHistories($emailHistories)
    {
        $this->emailHistories = $emailHistories;
    }

    /**
     * @param EmailHistory $emailHistory
     */
    public function addEmailHistory(EmailHistory $emailHistory)
    {
        if (!$this->emailHistories->contains($emailHistory)) {
            $this->emailHistories->add($emailHistory);
        }
    }

    /**
     * @param EmailHistory $emailHistory
     */
    public function removeEmailHistory(EmailHistory $emailHistory)
    {
        if ($this->emailHistories->contains($emailHistory)) {
            $this->emailHistories->removeElement($emailHistory);
        }
    }

    /**
     * Gets the last date this quote was sent
     */
    public function getLastEmailSentDate()
    {
        $dates = [];
        /** @var EmailHistory $emailHistory */
        foreach ($this->emailHistories as $emailHistory) {
            $dates[] = $emailHistory->getCreatedAt();
        }
        rsort($dates);
        $date = reset($dates);

        return $date ? $date : null;
    }
}