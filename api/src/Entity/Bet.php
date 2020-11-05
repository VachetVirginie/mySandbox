<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=BetRepository::class)
 */
class Bet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Match::class, inversedBy="bets")
     */
    private $Match;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $result;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bets")
     */
    private $gambler;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatch(): ?Match
    {
        return $this->Match;
    }

    public function setMatch(?Match $Match): self
    {
        $this->Match = $Match;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(string $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getGambler(): ?User
    {
        return $this->gambler;
    }

    public function setGambler(?User $gambler): self
    {
        $this->gambler = $gambler;

        return $this;
    }
}
