<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="favoriteTeam")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Match::class, mappedBy="homeTeam")
     */
    private $homeMatches;

    /**
     * @ORM\OneToMany(targetEntity=Match::class, mappedBy="awayTeam")
     */
    private $awayMatches;


    public function __construct()
    {
        $this->homeMatches = new ArrayCollection();
        $this->awayMatches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $Name): self
    {
        $this->name = $Name;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setFavoriteTeam($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getFavoriteTeam() === $this) {
                $user->setFavoriteTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Match[]
     */
    public function getHomeMatches(): Collection
    {
        return $this->homeMatches;
    }

    public function addHomeMatch(Match $homeMatch): self
    {
        if (!$this->homeMatches->contains($homeMatch)) {
            $this->homeMatches[] = $homeMatch;
            $homeMatch->setHomeTeam($this);
        }

        return $this;
    }

    public function removeHomeMatch(Match $homeMatch): self
    {
        if ($this->homeMatches->contains($homeMatch)) {
            $this->homeMatches->removeElement($homeMatch);
            // set the owning side to null (unless already changed)
            if ($homeMatch->getHomeTeam() === $this) {
                $homeMatch->setHomeTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Match[]
     */
    public function getAwayMatches(): Collection
    {
        return $this->awayMatches;
    }

    public function addAwayMatch(Match $awayMatch): self
    {
        if (!$this->awayMatches->contains($awayMatch)) {
            $this->awayMatches[] = $awayMatch;
            $awayMatch->setAwayTeam($this);
        }

        return $this;
    }

    public function removeAwayMatch(Match $awayMatch): self
    {
        if ($this->awayMatches->contains($awayMatch)) {
            $this->awayMatches->removeElement($awayMatch);
            // set the owning side to null (unless already changed)
            if ($awayMatch->getAwayTeam() === $this) {
                $awayMatch->setAwayTeam(null);
            }
        }

        return $this;
    }
}
