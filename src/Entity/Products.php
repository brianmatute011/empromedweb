<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $Type;

    #[ORM\Column(type: 'integer')]
    private $Total;

    #[ORM\ManyToOne(targetEntity: Laboratory::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false, name: "products", referencedColumnName: "id", onDelete: "CASCADE")]
    private $LaboratoryID;

    #[ORM\OneToMany(mappedBy: 'IDP', targetEntity: Production::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $productionsProd;

    #[ORM\OneToMany(mappedBy: 'PCCPID', targetEntity: ChCompProd::class)]
    private $chCompProds;

    public function __construct()
    {
        $this->productionsProd = new ArrayCollection();
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


    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->Total;
    }

    public function setTotal(int $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    public function getLaboratoryID(): ?Laboratory
    {
        return $this->LaboratoryID;
    }

    public function setLaboratoryID(?Laboratory $LaboratoryID): self
    {
        $this->LaboratoryID = $LaboratoryID;

        return $this;
    }

    /**
     * @return Collection<int, Production>
     */
    public function getProductionsProd(): Collection
    {
        return $this->productionsProd;
    }

    public function addProduction(Production $production): self
    {
        if (!$this->productionsProd->contains($production)) {
            $this->productionsProd[] = $production;
            $production->setIDP($this);
        }

        return $this;
    }

    public function removeProduction(Production $production): self
    {
        if ($this->productionsProd->removeElement($production)) {
            // set the owning side to null (unless already changed)
            if ($production->getIDP() === $this) {
                $production->setIDP(null);
            }
        }

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
            $chCompProd->setPCCPID($this);
        }

        return $this;
    }

    public function removeChCompProd(ChCompProd $chCompProd): self
    {
        if ($this->chCompProds->removeElement($chCompProd)) {
            // set the owning side to null (unless already changed)
            if ($chCompProd->getPCCPID() === $this) {
                $chCompProd->setPCCPID(null);
            }
        }

        return $this;
    }
}
