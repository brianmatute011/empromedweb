<?php

namespace App\Entity;

use App\Repository\LaboratoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LaboratoryRepository::class)]
class Laboratory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $labname;

    #[ORM\Column(type: 'string', length: 255)]
    private $labtype;

    #[ORM\OneToMany(mappedBy: 'LaboratoryID', targetEntity: Products::class)]
    private $products;

    #[ORM\OneToMany(mappedBy: 'LWID', targetEntity: Workers::class)]
    private $labworkers;



    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->labworkers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabname(): ?string
    {
        return $this->labname;
    }

    public function setLabname(string $labname): self
    {
        $this->labname = $labname;

        return $this;
    }

    public function getLabtype(): ?string
    {
        return $this->labtype;
    }

    public function setLabtype(string $labtype): self
    {
        $this->labtype = $labtype;

        return $this;
    }


    /**
     * @return Collection<int, Products>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setLaboratoryID($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getLaboratoryID() === $this) {
                $product->setLaboratoryID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Workers>
     */
    public function getLabworkers(): Collection
    {
        return $this->labworkers;
    }

    public function addLabworker(Workers $labworker): self
    {
        if (!$this->labworkers->contains($labworker)) {
            $this->labworkers[] = $labworker;
            $labworker->setLWID($this);
        }

        return $this;
    }

    public function removeLabworker(Workers $labworker): self
    {
        if ($this->labworkers->removeElement($labworker)) {
            // set the owning side to null (unless already changed)
            if ($labworker->getLWID() === $this) {
                $labworker->setLWID(null);
            }
        }

        return $this;
    }



}
