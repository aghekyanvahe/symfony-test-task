<?php

namespace App\SkyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\StarRepository;

/**
 * @ORM\Entity(repositoryClass=StarRepository::class)
 */
class Star
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
     * @ORM\ManyToOne(targetEntity=Galaxy::class, inversedBy="stars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $galaxy;

    /**
     * @ORM\Column(type="float")
     */
    private $Radius;

    /**
     * @ORM\Column(type="float")
     */
    private $Temperature;

    /**
     * @ORM\Column(type="float")
     */
    private $RotationFrequency;

    /**
     * @ORM\ManyToMany(targetEntity=Atom::class, mappedBy="star")
     */
    private $atoms;


    public function __construct()
    {
        $this->atoms = new ArrayCollection();
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

    public function getGalaxy(): ?Galaxy
    {
        return $this->galaxy;
    }

    public function setGalaxy(?Galaxy $galaxy): self
    {
        $this->galaxy = $galaxy;

        return $this;
    }

    public function getRadius(): ?float
    {
        return $this->Radius;
    }

    public function setRadius(float $Radius): self
    {
        $this->Radius = $Radius;

        return $this;
    }

    public function getTemperature(): ?float
    {
        return $this->Temperature;
    }

    public function setTemperature(float $Temperature): self
    {
        $this->Temperature = $Temperature;

        return $this;
    }

    public function getRotationFrequency(): ?float
    {
        return $this->RotationFrequency;
    }

    public function setRotationFrequency(float $RotationFrequency): self
    {
        $this->RotationFrequency = $RotationFrequency;

        return $this;
    }

    public function getAtoms(): Collection
    {
        return $this->atoms;
    }

    public function addAtom(Atom $atom): self
    {
        if (!$this->atoms->contains($atom)) {
            $this->atoms[] = $atom;
            $atom->addStar($this);
        }

        return $this;
    }

    public function removeAtom(Atom $atom): self
    {
        if ($this->atoms->removeElement($atom)) {
            $atom->removeStar($this);
        }

        return $this;
    }

}
