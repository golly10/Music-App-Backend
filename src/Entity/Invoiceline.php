<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoiceline
 *
 * @ORM\Table(name="InvoiceLine", indexes={@ORM\Index(name="IFK_InvoiceLineTrackId", columns={"TrackId"}), @ORM\Index(name="IFK_InvoiceLineInvoiceId", columns={"InvoiceId"})})
 * @ORM\Entity(repositoryClass="App\Repository\InvoicelineRepository");
 */
class Invoiceline
{
    /**
     * @var int
     *
     * @ORM\Column(name="InvoiceLineId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $invoicelineid;

    /**
     * @var string
     *
     * @ORM\Column(name="UnitPrice", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $unitprice;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var \Invoice
     *
     * @ORM\ManyToOne(targetEntity="Invoice")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="InvoiceId", referencedColumnName="InvoiceId")
     * })
     */
    private $invoiceid;

    /**
     * @var \Track
     *
     * @ORM\ManyToOne(targetEntity="Track")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TrackId", referencedColumnName="TrackId")
     * })
     */
    private $trackid;

    public function getInvoicelineid(): ?int
    {
        return $this->invoicelineid;
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getInvoiceid(): ?Invoice
    {
        return $this->invoiceid;
    }

    public function setInvoiceid(?Invoice $invoiceid): self
    {
        $this->invoiceid = $invoiceid;

        return $this;
    }

    public function getTrackid(): ?Track
    {
        return $this->trackid;
    }

    public function setTrackid(?Track $trackid): self
    {
        $this->trackid = $trackid;

        return $this;
    }


}
