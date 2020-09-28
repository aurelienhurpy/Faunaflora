<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IntroRepository")
 * @Vich\Uploadable
 */
class Intro
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $fileName;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="fauna_image", fileNameProperty="fileName")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover_image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="text")
     */
    private $contentb;

    /**
     * @ORM\Column(type="text")
     */
    private $contentc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->cover_image;
    }

    public function setCoverImage(?string $cover_image): self
    {
        $this->cover_image = $cover_image;

        return $this;
    }

    /**
     * @return null|string
     */

     public function getFileName(): ?string{

        return $this->fileName;

     }

    /**
     * @param null|string $fileName
     * @return Intro
     */

    public function setFileName(?string $fileName): Intro{

        $this->fileName = $fileName;
        return $this;

    }

    /**
     * @return null|File
     */

    public function getImageFile(): ?File{

        return $this->imageFile;

    }

    /**
     * @param null|File $imageFile
     * @return Intro
     */

    public function setImageFile(?File $imageFile): Intro{

        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;

    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getContentb(): ?string
    {
        return $this->contentb;
    }

    public function setContentb(string $contentb): self
    {
        $this->contentb = $contentb;

        return $this;
    }

    public function getContentc(): ?string
    {
        return $this->contentc;
    }

    public function setContentc(string $contentc): self
    {
        $this->contentc = $contentc;

        return $this;
    }


}
