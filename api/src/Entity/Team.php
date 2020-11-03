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
    private $Name;

    /**
     * @ORM\ManyToOne(targetEntity=Match::class, inversedBy="awayTeam")
     */
    private $awayMatches;

    /**
     * @ORM\ManyToOne(targetEntity=Match::class, inversedBy="homeTeam")
     */
    private $homeMatches;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="favoriteTeam")
     */
    private $users;

    public function __construct()
    {
        $this->homeMatches = new ArrayCollection();
        $this->awayMatches = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getAwayMatches(): ?Match
    {
        return $this->awayMatches;
    }

    public function setAwayMatches(?Match $awayMatches): self
    {
        $this->awayMatches = $awayMatches;

        return $this;
    }

    public function getHomeMatches(): ?Match
    {
        return $this->homeMatches;
    }

    public function setHomeMatches(?Match $homeMatches): self
    {
        $this->homeMatches = $homeMatches;

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
}
