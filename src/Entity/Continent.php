<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContinentRepository")
 */
class Continent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Decouverte", mappedBy="continent_id")
     */
    private $decouvertes;

    public function __construct()
    {
        $this->decouvertes = new ArrayCollection();
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

    /**
     * @return Collection|Decouverte[]
     */
    public function getDecouvertes(): Collection
    {
        return $this->decouvertes;
    }

    public function addDecouverte(Decouverte $decouverte): self
    {
        if (!$this->decouvertes->contains($decouverte)) {
            $this->decouvertes[] = $decouverte;
            $decouverte->setContinentId($this);
        }

        return $this;
    }

    public function removeDecouverte(Decouverte $decouverte): self
    {
        if ($this->decouvertes->contains($decouverte)) {
            $this->decouvertes->removeElement($decouverte);
            // set the owning side to null (unless already changed)
            if ($decouverte->getContinentId() === $this) {
                $decouverte->setContinentId(null);
            }
        }

        return $this;
    }
}
