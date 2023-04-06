<?php

namespace App\SkyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GalaxyRepository;

/**
 * @ORM\Entity(repositoryClass=GalaxyRepository::class)
 */
class Galaxy
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
     * @ORM\OneToMany(targetEntity=Star::class, mappedBy="galaxy", orphanRemoval=true)
     */
    private $stars;

    public function __construct()
    {
        $this->stars = new ArrayCollection();
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

    /**
     * @return Collection<array, Star>
     */
    public function getStars(): Collection
    {
        return $this->stars;
    }

    public function addStar(Star $star): self
    {
        if (!$this->stars->contains($star)) {
            $this->stars[] = $star;
            $star->setGalaxy($this);
        }

        return $this;
    }

    public function getAtom(Galaxy $galaxy , Atom  $atom): self
    {

        if (!$this->stars->contains($star)) {
            $this->stars[] = $star;
            $star->setGalaxy($this);
        }

        return $this;
    }
    public function removeStar(Star $star): self
    {
        if ($this->stars->removeElement($star)) {
            // set the owning side to null (unless already changed)
            if ($star->getGalaxy() === $this) {
                $star->setGalaxy(null);
            }
        }

        return $this;
    }
}
