<?php
namespace App\Entity\Quote;

use App\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EmailHistory
 * @package App\Entity\Quote
 * @ORM\Entity()
 * @ORM\Table(name="quote_email_history")
 */
class EmailHistory
{
    use TimestampableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Quote", inversedBy="emailHistories")
     */
    private $quote;

    /**
     * @ORM\Column(nullable=true)
     */
    private $recipients;

    /**
     * @ORM\Column(nullable=true)
     */
    private $subject;

    /**
     * @ORM\Column(type="text")
     */
    private $emailBody;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Quote\Pdf", inversedBy="emailHistories")
     * @ORM\JoinTable(name="quote_emails_pdfs")
     */
    private $pdfs;

    public function __construct() {
        $this->pdfs = new ArrayCollection();
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
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param mixed $recipients
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getEmailBody()
    {
        return $this->emailBody;
    }

    /**
     * @param mixed $emailBody
     */
    public function setEmailBody($emailBody)
    {
        $this->emailBody = $emailBody;
    }

    /**
     * @return mixed
     */
    public function getPdfs()
    {
        return $this->pdfs;
    }

    /**
     * @param mixed $pdfs
     */
    public function setPdfs($pdfs)
    {
        $this->pdfs = $pdfs;
    }

    /**
     * @param Pdf $pdf
     */
    public function addPdf(Pdf $pdf)
    {
        if (!$this->pdfs->contains($pdf)) {
            $this->pdfs->add($pdf);
        }
    }

    /**
     * @param Pdf $pdf
     */
    public function removePdf(Pdf $pdf)
    {
        if ($this->pdfs->contains($pdf)) {
            $this->pdfs->removeElement($pdf);
        }
    }
}