<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="Invoice", indexes={@ORM\Index(name="IFK_InvoiceCustomerId", columns={"CustomerId"})})
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository");
 */
class Invoice
{
    /**
     * @var int
     *
     * @ORM\Column(name="InvoiceId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $invoiceid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="InvoiceDate", type="datetime", nullable=false)
     */
    private $invoicedate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BillingAddress", type="string", length=70, nullable=true)
     */
    private $billingaddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BillingCity", type="string", length=40, nullable=true)
     */
    private $billingcity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BillingState", type="string", length=40, nullable=true)
     */
    private $billingstate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BillingCountry", type="string", length=40, nullable=true)
     */
    private $billingcountry;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BillingPostalCode", type="string", length=10, nullable=true)
     */
    private $billingpostalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="Total", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $total;

    /**
     * @var \Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CustomerId", referencedColumnName="CustomerId")
     * })
     */
    private $customerid;

    public function getInvoiceid(): ?int
    {
        return $this->invoiceid;
    }

    public function getInvoicedate(): ?\DateTimeInterface
    {
        return $this->invoicedate;
    }

    public function setInvoicedate(\DateTimeInterface $invoicedate): self
    {
        $this->invoicedate = $invoicedate;

        return $this;
    }

    public function getBillingaddress(): ?string
    {
        return $this->billingaddress;
    }

    public function setBillingaddress(?string $billingaddress): self
    {
        $this->billingaddress = $billingaddress;

        return $this;
    }

    public function getBillingcity(): ?string
    {
        return $this->billingcity;
    }

    public function setBillingcity(?string $billingcity): self
    {
        $this->billingcity = $billingcity;

        return $this;
    }

    public function getBillingstate(): ?string
    {
        return $this->billingstate;
    }

    public function setBillingstate(?string $billingstate): self
    {
        $this->billingstate = $billingstate;

        return $this;
    }

    public function getBillingcountry(): ?string
    {
        return $this->billingcountry;
    }

    public function setBillingcountry(?string $billingcountry): self
    {
        $this->billingcountry = $billingcountry;

        return $this;
    }

    public function getBillingpostalcode(): ?string
    {
        return $this->billingpostalcode;
    }

    public function setBillingpostalcode(?string $billingpostalcode): self
    {
        $this->billingpostalcode = $billingpostalcode;

        return $this;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getCustomerid(): ?Customer
    {
        return $this->customerid;
    }

    public function setCustomerid(?Customer $customerid): self
    {
        $this->customerid = $customerid;

        return $this;
    }


}
