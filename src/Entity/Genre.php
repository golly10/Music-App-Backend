<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="Genre")
 * @ORM\Entity(repositoryClass="App\Repository\GenreRepository");
 */
class Genre
{
    /**
     * @var int
     *
     * @ORM\Column(name="GenreId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $genreid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=120, nullable=true)
     */
    private $nameGenre;

    public function getGenreid(): ?int
    {
        return $this->genreid;
    }

    public function getName(): ?string
    {
        return $this->nameGenre;
    }

    public function setName(?string $name): self
    {
        $this->nameGenre = $name;

        return $this;
    }


}
