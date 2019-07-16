<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mediatype
 *
 * @ORM\Table(name="MediaType")
 * @ORM\Entity(repositoryClass="App\Repository\MediatypeRepo");
 */
class Mediatype
{
    /**
     * @var int
     *
     * @ORM\Column(name="MediaTypeId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mediatypeid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=120, nullable=true)
     */
    private $nameMediatype;

    public function getMediatypeid(): ?int
    {
        return $this->mediatypeid;
    }

    public function getName(): ?string
    {
        return $this->$nameMediatype;
    }

    public function setName(?string $name): self
    {
        $this->$nameMediatype = $name;

        return $this;
    }


}
