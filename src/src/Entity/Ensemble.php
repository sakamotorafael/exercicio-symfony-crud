<?php

namespace App\Entity;

use App\Repository\EnsembleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnsembleRepository::class)
 */
class Ensemble
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
     * @ORM\Column(type="integer")
     */
    private $partsCount;


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

    public function getPartsCount(): ?int
    {
        return $this->partsCount;
    }

    public function setPartsCount(int $partsCount): self
    {
        $this->partsCount = $partsCount;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
