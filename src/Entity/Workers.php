<?php

namespace App\Entity;

use App\Repository\WorkersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkersRepository::class)]
class Workers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'smallint')]
    private $age;

    #[ORM\Column(type: 'string', length: 1)]
    private $sex;

    #[ORM\Column(type: 'string', length: 255)]
    private $position;

    #[ORM\Column(type: 'smallint')]
    private $year_experiences;

    #[ORM\Column(type: 'float')]
    private $salario;

    #[ORM\ManyToOne(targetEntity: Laboratory::class, inversedBy: 'labworkers')]
    private $LWID;

    #[ORM\OneToMany(mappedBy: 'WLID', targetEntity: Laboratory::class)]
    private $laboratories;

    #[ORM\OneToMany(mappedBy: 'IDW', targetEntity: Production::class)]
    private $productions;

    #[ORM\OneToMany(mappedBy: 'TEID', targetEntity: Evaluation::class)]
    private $evaluations;

    public function __construct()
    {
        $this->laboratories = new ArrayCollection();
        $this->productions = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getYearExperiences(): ?int
    {
        return $this->year_experiences;
    }

    public function setYearExperiences(int $year_experiences): self
    {
        $this->year_experiences = $year_experiences;

        return $this;
    }

    public function getSalario(): ?float
    {
        return $this->salario;
    }

    public function setSalario(float $salario): self
    {
        $this->salario = $salario;

        return $this;
    }

    public function getLWID(): ?Laboratory
    {
        return $this->LWID;
    }

    public function setLWID(?Laboratory $LWID): self
    {
        $this->LWID = $LWID;

        return $this;
    }

    /**
     * @return Collection<int, Laboratory>
     */
    public function getLaboratories(): Collection
    {
        return $this->laboratories;
    }

    public function addLaboratory(Laboratory $laboratory): self
    {
        if (!$this->laboratories->contains($laboratory)) {
            $this->laboratories[] = $laboratory;
            $laboratory->setWLID($this);
        }

        return $this;
    }

    public function removeLaboratory(Laboratory $laboratory): self
    {
        if ($this->laboratories->removeElement($laboratory)) {
            // set the owning side to null (unless already changed)
            if ($laboratory->getWLID() === $this) {
                $laboratory->setWLID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Production>
     */
    public function getProductions(): Collection
    {
        return $this->productions;
    }

    public function addProduction(Production $production): self
    {
        if (!$this->productions->contains($production)) {
            $this->productions[] = $production;
            $production->setIDW($this);
        }

        return $this;
    }

    public function removeProduction(Production $production): self
    {
        if ($this->productions->removeElement($production)) {
            // set the owning side to null (unless already changed)
            if ($production->getIDW() === $this) {
                $production->setIDW(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evaluation>
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setTEID($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getTEID() === $this) {
                $evaluation->setTEID(null);
            }
        }

        return $this;
    }
}
