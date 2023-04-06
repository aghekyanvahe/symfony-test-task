<?php

namespace App\SkyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AtomRepository;

/**
 * @ORM\Entity(repositoryClass=AtomRepository::class)
 */
class Atom
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
     * @ORM\ManyToMany(targetEntity=Star::class, inversedBy="atoms")
     */
    private $star;

    public function __construct()
    {
        $this->star = new ArrayCollection();
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
     * @return Collection<int, Star>
     */
    public function getStar(): Collection
    {
        return $this->star;
    }

    public function addStar(Star $star): self
    {
        if (!$this->star->contains($star)) {
            $this->star[] = $star;
        }

        return $this;
    }

    public function removeStar(Star $star): self
    {
        $this->star->removeElement($star);

        return $this;
    }
}
