<?php

namespace App\Entity;

use App\Repository\JugadorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JugadorRepository::class)
 */
class Jugador
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $gols;

    /**
     * @ORM\Column(type="integer")
     */
    private $assist;

    /**
     * @ORM\Column(type="integer")
     */
    private $xuts_porta;

    /**
     * @ORM\Column(type="integer")
     */
    private $xuts_fora;

    /**
     * @ORM\Column(type="integer")
     */
    private $perdues;

    /**
     * @ORM\Column(type="integer")
     */
    private $recuperacions;

    /**
     * @ORM\Column(type="integer")
     */
    private $intercepcions;

    /**
     * @ORM\Column(type="integer")
     */
    private $partits;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGols(): ?int
    {
        return $this->gols;
    }

    public function setGols(int $gols): self
    {
        $this->gols = $gols;

        return $this;
    }

    public function getAssist(): ?int
    {
        return $this->assist;
    }

    public function setAssist(int $assist): self
    {
        $this->assist = $assist;

        return $this;
    }

    public function getXutsPorta(): ?int
    {
        return $this->xuts_porta;
    }

    public function setXutsPorta(int $xuts_porta): self
    {
        $this->xuts_porta = $xuts_porta;

        return $this;
    }

    public function getXutsFora(): ?int
    {
        return $this->xuts_fora;
    }

    public function setXutsFora(int $xuts_fora): self
    {
        $this->xuts_fora = $xuts_fora;

        return $this;
    }

    public function getPerdues(): ?int
    {
        return $this->perdues;
    }

    public function setPerdues(int $perdues): self
    {
        $this->perdues = $perdues;

        return $this;
    }

    public function getRecuperacions(): ?int
    {
        return $this->recuperacions;
    }

    public function setRecuperacions(int $recuperacions): self
    {
        $this->recuperacions = $recuperacions;

        return $this;
    }

    public function getIntercepcions(): ?int
    {
        return $this->intercepcions;
    }

    public function setIntercepcions(int $intercepcions): self
    {
        $this->intercepcions = $intercepcions;

        return $this;
    }

    public function getPartits(): ?int
    {
        return $this->partits;
    }

    public function setPartits(int $partits): self
    {
        $this->partits = $partits;

        return $this;
    }

    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'gols' => $this->getGols(),
            'assist' => $this->getAssist(),
            'xuts_fora' => $this->getXutsFora(),
            'xuts_porta' => $this->getXutsPorta(),
            'perdues' => $this->getPerdues(),
            'recuperacions' => $this->getRecuperacions(),
            'intercepcions' => $this->getIntercepcions(),
            'partits' => $this->getPartits(),
        );
    }
}
