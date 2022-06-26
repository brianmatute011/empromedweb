<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $evaluation_date;

    #[ORM\Column(type: 'string', length: 255)]
    private $result;

    #[ORM\Column(type: 'string', length: 255)]
    private $comment;

    #[ORM\ManyToOne(targetEntity: Production::class, inversedBy: 'evaluationsProd')]
    #[ORM\JoinColumn(nullable: false, name: 'evaluationsProd', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private $PEID;

    #[ORM\ManyToOne(targetEntity: Workers::class, inversedBy: 'evaluationsWork')]
    #[ORM\JoinColumn(nullable: false, name: 'evaluationsWork', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private $TEID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvaluationDate(): ?\DateTimeInterface
    {
        return $this->evaluation_date;
    }

    public function setEvaluationDate(\DateTimeInterface $evaluation_date): self
    {
        $this->evaluation_date = $evaluation_date;

        return $this;
    }

    public function getResult() : string
    {
        return (string) $this->result;
    }

    public function setResult($result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getPEID(): ?Production
    {
        return $this->PEID;
    }

    public function setPEID(?Production $PEID): self
    {
        $this->PEID = $PEID;

        return $this;
    }

    public function getTEID(): ?Workers
    {
        return $this->TEID;
    }

    public function setTEID(?Workers $TEID): self
    {
        $this->TEID = $TEID;

        return $this;
    }
}
