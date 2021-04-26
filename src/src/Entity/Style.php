<?php

namespace App\Entity;

use App\Repository\StyleRepository;
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
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     */
    private $mainRegion;

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

    public function getMainRegion(): ?string
    {
        return $this->mainRegion;
    }

    public function setMainRegion(string $mainRegion): self
    {
        $this->mainRegion = $mainRegion;

        return $this;
    }
}
