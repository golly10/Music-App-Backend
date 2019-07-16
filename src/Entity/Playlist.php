<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Playlist
 *
 * @ORM\Table(name="Playlist")
 * @ORM\Entity(repositoryClass="App\Repository\PlaylistRepository");
 */
class Playlist
{
    /**
     * @var int
     *
     * @ORM\Column(name="PlaylistId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $playlistid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=120, nullable=true)
     */
    private $namePlaylist;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Track", inversedBy="playlistid")
     * @ORM\JoinTable(name="playlisttrack",
     *   joinColumns={
     *     @ORM\JoinColumn(name="PlaylistId", referencedColumnName="PlaylistId")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="TrackId", referencedColumnName="TrackId")
     *   }
     * )
     */
    private $trackid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trackid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getPlaylistid(): ?int
    {
        return $this->playlistid;
    }

    public function getName(): ?string
    {
        return $this->$namePlaylist;
    }

    public function setName(?string $name): self
    {
        $this->$namePlaylist = $name;

        return $this;
    }

    /**
     * @return Collection|Track[]
     */
    public function getTrackid(): Collection
    {
        return $this->trackid;
    }

    public function addTrackid(Track $trackid): self
    {
        if (!$this->trackid->contains($trackid)) {
            $this->trackid[] = $trackid;
        }

        return $this;
    }

    public function removeTrackid(Track $trackid): self
    {
        if ($this->trackid->contains($trackid)) {
            $this->trackid->removeElement($trackid);
        }

        return $this;
    }

}
