<?php

namespace App\Entity;

use App\Repository\RespLabRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RespLabRepository::class)]
class RespLab
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(targetEntity: Workers::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private $IDRESPW;

    #[ORM\OneToOne(targetEntity: Laboratory::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private $IDERESPL;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDRESPW(): ?Workers
    {
        return $this->IDRESPW;
    }

    public function setIDRESPW(Workers $IDRESPW): self
    {
        $this->IDRESPW = $IDRESPW;

        return $this;
    }

    public function getIDERESPL(): ?Laboratory
    {
        return $this->IDERESPL;
    }

    public function setIDERESPL(Laboratory $IDERESPL): self
    {
        $this->IDERESPL = $IDERESPL;

        return $this;
    }
}
