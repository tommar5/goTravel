<?php
namespace App\Traits\Template;

use Doctrine\ORM\Mapping as ORM;

trait TemplateTrait
{
    /**
     * @ORM\Column(name="seo_title", nullable=true)
     */
    private $seoTitle;

    /**
     * @ORM\Column(name="seo_meta_description", type="text", nullable=true)
     */
    private $seoMetaDescription;

    /**
     * @ORM\Column(name="template_h1", nullable=true)
     */
    private $h1;

    /**
     * @ORM\Column(name="template_h2", nullable=true)
     */
    private $h2;

    /**
     * @return mixed
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * @param mixed $seoTitle
     */
    public function setSeoTitle($seoTitle): void
    {
        $this->seoTitle = $seoTitle;
    }

    /**
     * @return mixed
     */
    public function getSeoMetaDescription()
    {
        return $this->seoMetaDescription;
    }

    /**
     * @param mixed $seoMetaDescription
     */
    public function setSeoMetaDescription($seoMetaDescription): void
    {
        $this->seoMetaDescription = $seoMetaDescription;
    }

    /**
     * @return mixed
     */
    public function getH1()
    {
        return $this->h1;
    }

    /**
     * @param mixed $h1
     */
    public function setH1($h1): void
    {
        $this->h1 = $h1;
    }

    /**
     * @return mixed
     */
    public function getH2()
    {
        return $this->h2;
    }

    /**
     * @param mixed $h2
     */
    public function setH2($h2): void
    {
        $this->h2 = $h2;
    }
}