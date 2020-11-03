<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MatchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MatchRepository::class)
 */
class Match
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datetime;

    /**
     * @ORM\Column(type="integer")
     */
    private $roundId;

    /**
     * @ORM\Column(type="integer")
     */
    private $homeScore = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $awayScore = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="awayMatches")
     */
    private $awayTeam;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="homeMatches")
     */
    private $homeTeam;

    public function __construct()
    {
        $this->awayTeam = new ArrayCollection();
        $this->homeTeam = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(?\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getRoundId(): ?int
    {
        return $this->roundId;
    }

    public function setRoundId(int $roundId): self
    {
        $this->roundId = $roundId;

        return $this;
    }

    public function getHomeScore(): ?int
    {
        return $this->homeScore;
    }

    public function setHomeScore(int $homeScore): self
    {
        $this->homeScore = $homeScore;

        return $this;
    }

    public function getAwayScore(): ?int
    {
        return $this->awayScore;
    }

    public function setAwayScore(int $awayScore): self
    {
        $this->awayScore = $awayScore;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getAwayTeam(): Collection
    {
        return $this->awayTeam;
    }

    public function addAwayTeam(Team $awayTeam): self
    {
        if (!$this->awayTeam->contains($awayTeam)) {
            $this->awayTeam[] = $awayTeam;
            $awayTeam->setAwayMatches($this);
        }

        return $this;
    }

    public function removeAwayTeam(Team $awayTeam): self
    {
        if ($this->awayTeam->contains($awayTeam)) {
            $this->awayTeam->removeElement($awayTeam);
            // set the owning side to null (unless already changed)
            if ($awayTeam->getAwayMatches() === $this) {
                $awayTeam->setAwayMatches(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getHomeTeam(): Collection
    {
        return $this->homeTeam;
    }

    public function addHomeTeam(Team $homeTeam): self
    {
        if (!$this->homeTeam->contains($homeTeam)) {
            $this->homeTeam[] = $homeTeam;
            $homeTeam->setHomeMatches($this);
        }

        return $this;
    }

    public function removeHomeTeam(Team $homeTeam): self
    {
        if ($this->homeTeam->contains($homeTeam)) {
            $this->homeTeam->removeElement($homeTeam);
            // set the owning side to null (unless already changed)
            if ($homeTeam->getHomeMatches() === $this) {
                $homeTeam->setHomeMatches(null);
            }
        }

        return $this;
    }
}
