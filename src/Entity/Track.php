<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Track
 *
 * @ORM\Table(name="Track", indexes={@ORM\Index(name="IFK_TrackGenreId", columns={"GenreId"}), @ORM\Index(name="IFK_TrackAlbumId", columns={"AlbumId"}), @ORM\Index(name="IFK_TrackMediaTypeId", columns={"MediaTypeId"})})
 * @ORM\Entity(repositoryClass="App\Repository\TrackRepository");
 */
class Track
{
    /**
     * @var int
     *
     * @ORM\Column(name="TrackId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $trackid;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=200, nullable=false)
     */
    private $nameTrack;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Composer", type="string", length=220, nullable=true)
     */
    private $composer;

    /**
     * @var int
     *
     * @ORM\Column(name="Milliseconds", type="integer", nullable=false)
     */
    private $milliseconds;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Bytes", type="integer", nullable=true)
     */
    private $bytes;

    /**
     * @var string
     *
     * @ORM\Column(name="UnitPrice", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $unitprice;

    /**
     * @var \Album
     *
     * @ORM\ManyToOne(targetEntity="Album")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="AlbumId", referencedColumnName="AlbumId")
     * })
     */
    private $albumid;

    /**
     * @var \Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GenreId", referencedColumnName="GenreId")
     * })
     */
    private $genreid;

    /**
     * @var \Mediatype
     *
     * @ORM\ManyToOne(targetEntity="Mediatype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MediaTypeId", referencedColumnName="MediaTypeId")
     * })
     */
    private $mediatypeid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Playlist", mappedBy="trackid")
     */
    private $playlistid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->playlistid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getTrackid(): ?int
    {
        return $this->trackid;
    }

    public function getName(): ?string
    {
        return $this->$nameTrack;
    }

    public function setName(string $name): self
    {
        $this->$nameTrack = $name;

        return $this;
    }

    public function getComposer(): ?string
    {
        return $this->composer;
    }

    public function setComposer(?string $composer): self
    {
        $this->composer = $composer;

        return $this;
    }

    public function getMilliseconds(): ?int
    {
        return $this->milliseconds;
    }

    public function setMilliseconds(int $milliseconds): self
    {
        $this->milliseconds = $milliseconds;

        return $this;
    }

    public function getBytes(): ?int
    {
        return $this->bytes;
    }

    public function setBytes(?int $bytes): self
    {
        $this->bytes = $bytes;

        return $this;
    }

    public function getUnitprice()
    {
        return $this->unitprice;
    }

    public function setUnitprice($unitprice): self
    {
        $this->unitprice = $unitprice;

        return $this;
    }

    public function getAlbumid(): ?Album
    {
        return $this->albumid;
    }

    public function setAlbumid(?Album $albumid): self
    {
        $this->albumid = $albumid;

        return $this;
    }

    public function getGenreid(): ?Genre
    {
        return $this->genreid;
    }

    public function setGenreid(?Genre $genreid): self
    {
        $this->genreid = $genreid;

        return $this;
    }

    public function getMediatypeid(): ?Mediatype
    {
        return $this->mediatypeid;
    }

    public function setMediatypeid(?Mediatype $mediatypeid): self
    {
        $this->mediatypeid = $mediatypeid;

        return $this;
    }

    /**
     * @return Collection|Playlist[]
     */
    public function getPlaylistid(): Collection
    {
        return $this->playlistid;
    }

    public function addPlaylistid(Playlist $playlistid): self
    {
        if (!$this->playlistid->contains($playlistid)) {
            $this->playlistid[] = $playlistid;
            $playlistid->addTrackid($this);
        }

        return $this;
    }

    public function removePlaylistid(Playlist $playlistid): self
    {
        if ($this->playlistid->contains($playlistid)) {
            $this->playlistid->removeElement($playlistid);
            $playlistid->removeTrackid($this);
        }

        return $this;
    }

}
