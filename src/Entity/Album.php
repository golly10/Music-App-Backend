<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 *
 * @ORM\Table(name="Album", indexes={@ORM\Index(name="IFK_AlbumArtistId", columns={"ArtistId"})})
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository");
 */
class Album
{
    /**
     * @var int
     *
     * @ORM\Column(name="AlbumId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $albumid;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=160, nullable=false)
     */
    private $nameAlbum;

    /**
     * @var \Artist
     *
     * @ORM\ManyToOne(targetEntity="Artist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ArtistId", referencedColumnName="ArtistId")
     * })
     */
    private $artistid;

    public function getAlbumid(): ?int
    {
        return $this->albumid;
    }

    public function getTitle(): ?string
    {
        return $this->$nameAlbum;
    }

    public function setTitle(string $title): self
    {
        $this->$nameAlbum = $title;

        return $this;
    }

    public function getArtistid(): ?Artist
    {
        return $this->artistid;
    }

    public function setArtistid(?Artist $artistid): self
    {
        $this->artistid = $artistid;

        return $this;
    }


}
