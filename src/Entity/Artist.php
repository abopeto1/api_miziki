<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 */
class Artist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\OneToOne(targetEntity=Person::class, cascade={"persist", "remove"})
     */
    private $person;

    /**
     * @ORM\ManyToMany(targetEntity=MusicRecording::class, mappedBy="byArtist")
     */
    private $tracks;

    public function __construct()
    {
        $this->tracks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    /**
     * @return Collection|MusicRecording[]
     */
    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    public function addTrack(MusicRecording $track): self
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks[] = $track;
            $track->addByArtist($this);
        }

        return $this;
    }

    public function removeTrack(MusicRecording $track): self
    {
        if ($this->tracks->contains($track)) {
            $this->tracks->removeElement($track);
            $track->removeByArtist($this);
        }

        return $this;
    }
}
