<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="book")
 */
class Book
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $author;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes={ "image/jpeg", "image/png" },
     *     maxSizeMessage = "Файл должен быть не больше 5МБ.",
     *     mimeTypesMessage = "Файл должен быть в формате jpg или png."
     * )
     */
    private $cover;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes={ "application/pdf" },
     *     maxSizeMessage = "Файл должен быть не больше 5МБ.",
     *     mimeTypesMessage = "Файл должен быть в формате PDF."
     * )
     */
    private $file;

    /**
     * @var date
     * @ORM\Column(type="date")
     * @Assert\DateTime()
     */
    private $dateRead;
    
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     * $ORM\Nullable
     */
    private $downloadable;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Book
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set dateRead
     *
     * @param \DateTime $dateRead
     *
     * @return Book
     */
    public function setDateRead($dateRead)
    {
        $this->dateRead = $dateRead;

        return $this;
    }

    /**
     * Get dateRead
     *
     * @return \DateTime
     */
    public function getDateRead()
    {
        return $this->dateRead;
    }

    /**
     * Set cover
     *
     * @param string $cover
     *
     * @return Book
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return Book
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set isDownloadable
     *
     * @param \bool $isDownloadable
     *
     * @return Book
     */
    public function setDownloadable($isDownloadable)
    {
        $this->downloadable = $isDownloadable;

        return $this;
    }

    /**
     * Get downloadable
     *
     * @return \bool
     */
    public function getDownloadable()
    {
        return $this->downloadable;
    }
}
