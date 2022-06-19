<?php

namespace App\Entity;

use App\Repository\ChemicalsComponetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChemicalsComponetsRepository::class)]
class ChemicalsComponets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 1)]
    private $ph;

    #[ORM\OneToMany(mappedBy: 'CCCCPID', targetEntity: ChCompProd::class)]
    private $chCompProds;

    public function __construct()
    {
        $this->chCompProds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPh(): ?string
    {
        return $this->ph;
    }

    public function setPh(string $ph): self
    {
        $this->ph = $ph;

        return $this;
    }

    /**
     * @return Collection<int, ChCompProd>
     */
    public function getChCompProds(): Collection
    {
        return $this->chCompProds;
    }

    public function addChCompProd(ChCompProd $chCompProd): self
    {
        if (!$this->chCompProds->contains($chCompProd)) {
            $this->chCompProds[] = $chCompProd;
            $chCompProd->setCCCCPID($this);
        }

        return $this;
    }

    public function removeChCompProd(ChCompProd $chCompProd): self
    {
        if ($this->chCompProds->removeElement($chCompProd)) {
            // set the owning side to null (unless already changed)
            if ($chCompProd->getCCCCPID() === $this) {
                $chCompProd->setCCCCPID(null);
            }
        }

        return $this;
    }
}
