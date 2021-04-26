<?php

namespace App\Entity;

use App\Repository\OeuvreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OeuvreRepository::class)
 */
class Oeuvre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Positive
     */
    private $opus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Positive
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tonality;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $catalogName;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     * @Assert\Positive
     */
    private $catalogNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="This field cannot contain a number"
     * )
     */
    private $genre;

    /**
     * @ORM\Column(type="integer")
     */
    private $composer;

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

    public function getOpus(): ?int
    {
        return $this->opus;
    }

    public function setOpus(?int $opus): self
    {
        $this->opus = $opus;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getTonality(): ?string
    {
        return $this->tonality;
    }

    public function setTonality(?string $tonality): self
    {
        $this->tonality = $tonality;

        return $this;
    }

    public function getCatalogName(): ?string
    {
        return $this->catalogName;
    }

    public function setCatalogName(?string $catalogName): self
    {
        $this->catalogName = $catalogName;

        return $this;
    }

    public function getCatalogNumber(): ?int
    {
        return $this->catalogNumber;
    }

    public function setCatalogNumber(?int $catalogNumber): self
    {
        $this->catalogNumber = $catalogNumber;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getComposer(): ?int
    {
        return $this->composer;
    }

    public function setComposer(int $composer): self
    {
        $this->composer = $composer;

        return $this;
    }
}
