<?php
namespace App\Traits\Template;

use Doctrine\ORM\Mapping as ORM;

trait ImageTrait
{
    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     */
    private $thumbnail;

    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     */
    private $coverImage;

    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     */
    private $image1;

    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     */
    private $image2;

    /**
     * @return string|null
     */
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * @param string|null $thumbnail
     */
    public function setThumbnail(?string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return string|null
     */
    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    /**
     * @param string|null $coverImage
     */
    public function setCoverImage(?string $coverImage): void
    {
        $this->coverImage = $coverImage;
    }

    /**
     * @return string|null
     */
    public function getImage1(): ?string
    {
        return $this->image1;
    }

    /**
     * @param string|null $image1
     */
    public function setImage1(?string $image1): void
    {
        $this->image1 = $image1;
    }

    /**
     * @return string|null
     */
    public function getImage2(): ?string
    {
        return $this->image2;
    }

    /**
     * @param string|null $image2
     */
    public function setImage2(?string $image2): void
    {
        $this->image2 = $image2;
    }
}