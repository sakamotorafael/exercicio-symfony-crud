<?php

namespace App\Entity;

use App\Repository\StyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=StyleRepository::class)
 */
class Style
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="This field cannot contain a number"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * 
     */
    private $startingYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     */
    private $endingYear;

    /**
     * @ORM\ManyToMany(targetEntity=Country::class, inversedBy="styles")
     */
    private $countriesRange;

    /**
     * @ORM\ManyToMany(targetEntity=Composer::class, mappedBy="styles")
     */
    private $composers;

    public function __construct()
    {
        $this->countriesRange = new ArrayCollection();
        $this->composers = new ArrayCollection();
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

    public function getStartingYear(): ?int
    {
        return $this->startingYear;
    }

    public function setStartingYear(int $startingYear): self
    {
        $this->startingYear = $startingYear;

        return $this;
    }

    public function getEndingYear(): ?int
    {
        return $this->endingYear;
    }

    public function setEndingYear(?int $endingYear): self
    {
        $this->endingYear = $endingYear;

        return $this;
    }

    /**
     * @return Collection|Country[]
     */
    public function getCountriesRange(): Collection
    {
        return $this->countriesRange;
    }

    public function addCountriesRange(Country $countriesRange): self
    {
        if (!$this->countriesRange->contains($countriesRange)) {
            $this->countriesRange[] = $countriesRange;
        }

        return $this;
    }

    public function removeCountriesRange(Country $countriesRange): self
    {
        $this->countriesRange->removeElement($countriesRange);

        return $this;
    }

    /**
     * @return Collection|Composer[]
     */
    public function getComposers(): Collection
    {
        return $this->composers;
    }

    public function addComposer(Composer $composer): self
    {
        if (!$this->composers->contains($composer)) {
            $this->composers[] = $composer;
            $composer->addStyle($this);
        }

        return $this;
    }

    public function removeComposer(Composer $composer): self
    {
        if ($this->composers->removeElement($composer)) {
            $composer->removeStyle($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

}
