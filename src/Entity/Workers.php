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
    #[ORM\Column(type: 'bigint')]
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


    #[ORM\OneToMany(mappedBy: 'IDW', targetEntity: Production::class)]
    private $productionsWork;

    #[ORM\OneToMany(mappedBy: 'TEID', targetEntity: Evaluation::class)]
    private $evaluationsWork;

    #[ORM\ManyToOne(targetEntity: Laboratory::class, inversedBy: 'labworkers')]
    #[ORM\JoinColumn(nullable: false, name: 'labworkers', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private $LWID;

    public function __construct()
    {
        $this->productionsWork = new ArrayCollection();
        $this->evaluationsWork = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
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




    /**
     * @return Collection<int, Production>
     */
    public function getProductionsWork(): Collection
    {
        return $this->productionsWork;
    }

    public function addProduction(Production $production): self
    {
        if (!$this->productionsWork->contains($production)) {
            $this->productionsWork[] = $production;
            $production->setIDW($this);
        }

        return $this;
    }

    public function removeProduction(Production $production): self
    {
        if ($this->productionsWork->removeElement($production)) {
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
    public function getEvaluationsWork(): Collection
    {
        return $this->evaluationsWork;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluationsWork->contains($evaluation)) {
            $this->evaluationsWork[] = $evaluation;
            $evaluation->setTEID($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluationsWork->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getTEID() === $this) {
                $evaluation->setTEID(null);
            }
        }

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

    public function __toString(): string
    {
        return $this->id . " " . $this->name;
    }
}
