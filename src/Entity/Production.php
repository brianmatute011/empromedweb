<?php

namespace App\Entity;

use App\Repository\ProductionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductionRepository::class)]
class Production
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $production_date;

    #[ORM\Column(type: 'integer')]
    private $cant;

    #[ORM\ManyToOne(targetEntity: Products::class, inversedBy: 'productionsProd')]
    #[ORM\JoinColumn(nullable: false, name: 'productionsProd', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private $IDP;

    #[ORM\ManyToOne(targetEntity: Workers::class, inversedBy: 'productionsWork')]
    #[ORM\JoinColumn(nullable: false, name: 'productionsWork', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private $IDW;

    #[ORM\OneToMany(mappedBy: 'PEID', targetEntity: Evaluation::class)]
    private $evaluationsProd;

    public function __construct()
    {
        $this->evaluationsProd = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductionDate(): ?\DateTimeInterface
    {
        return $this->production_date;
    }

    public function setProductionDate(\DateTimeInterface $production_date): self
    {
        $this->production_date = $production_date;

        return $this;
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

    public function getIDP(): ?Products
    {
        return $this->IDP;
    }

    public function setIDP(?Products $IDP): self
    {
        $this->IDP = $IDP;

        return $this;
    }

    public function getIDW(): ?Workers
    {
        return $this->IDW;
    }

    public function setIDW(?Workers $IDW): self
    {
        $this->IDW = $IDW;

        return $this;
    }

    /**
     * @return Collection<int, Evaluation>
     */
    public function getEvaluationsProd(): Collection
    {
        return $this->evaluationsProd;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluationsProd->contains($evaluation)) {
            $this->evaluationsProd[] = $evaluation;
            $evaluation->setPEID($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluationsProd->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getPEID() === $this) {
                $evaluation->setPEID(null);
            }
        }

        return $this;
    }
}
