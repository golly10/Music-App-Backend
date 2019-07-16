<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artist
 *
 * @ORM\Table(name="Artist")
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository");
 */
class Artist
{
    /**
     * @var int
     *
     * @ORM\Column(name="ArtistId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $artistid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=120, nullable=true)
     */
    private $nameArtist;

    public function getArtistid(): ?int
    {
        return $this->artistid;
    }

    public function getName(): ?string
    {
        return $this->nameArtist;
    }

    public function setName(?string $name): self
    {
        $this->nameArtist = $name;

        return $this;
    }


}
