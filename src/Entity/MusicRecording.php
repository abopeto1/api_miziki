<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MusicRecordingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MusicRecordingRepository::class)
 */
class MusicRecording
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Artist::class, inversedBy="tracks")
     */
    private $byArtist;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datePublished;

    public function __construct()
    {
        $this->byArtist = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getByArtist(): Collection
    {
        return $this->byArtist;
    }

    public function addByArtist(Artist $byArtist): self
    {
        if (!$this->byArtist->contains($byArtist)) {
            $this->byArtist[] = $byArtist;
        }

        return $this;
    }

    public function removeByArtist(Artist $byArtist): self
    {
        if ($this->byArtist->contains($byArtist)) {
            $this->byArtist->removeElement($byArtist);
        }

        return $this;
    }

    public function getDatePublished(): ?\DateTimeInterface
    {
        return $this->datePublished;
    }

    public function setDatePublished(?\DateTimeInterface $datePublished): self
    {
        $this->datePublished = $datePublished;

        return $this;
    }
}
