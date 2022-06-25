<?php

namespace App\Entity;

use App\Repository\ChCompProdRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChCompProdRepository::class)]
class ChCompProd
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $cant;

    #[ORM\ManyToOne(targetEntity: Products::class, inversedBy: 'chCompProds')]
    #[ORM\JoinColumn(nullable: false, name: 'chCompProds', referencedColumnName: "id", onDelete: "CASCADE")]
    private $PCCPID;

    #[ORM\ManyToOne(targetEntity: ChemicalsComponets::class, inversedBy: 'chCompCComp')]
    #[ORM\JoinColumn(nullable: false, name: 'chCompCComp', referencedColumnName: "id", onDelete: "CASCADE")]
    private $CCCCPID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCant(): ?int
    {
        return $this->cant;
    }

    public function setCant(int $cant): self
    {
        $this->cant = $cant;

        return $this;
    }

    public function getPCCPID(): ?Products
    {
        return $this->PCCPID;
    }

    public function setPCCPID(?Products $PCCPID): self
    {
        $this->PCCPID = $PCCPID;

        return $this;
    }

    public function getCCCCPID(): ?ChemicalsComponets
    {
        return $this->CCCCPID;
    }

    public function setCCCCPID(?ChemicalsComponets $CCCCPID): self
    {
        $this->CCCCPID = $CCCCPID;

        return $this;
    }
}
