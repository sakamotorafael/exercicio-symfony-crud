<?php

namespace App\Entity;

use App\Repository\CatalogageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CatalogageRepository::class)
 */
class Catalogage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Catalogue::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $catalogue;

    /**
     * @ORM\OneToOne(targetEntity=Oeuvre::class, inversedBy="catalogage", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $oeuvre;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatalogue(): ?Catalogue
    {
        return $this->catalogue;
    }

    public function setCatalogue(?Catalogue $catalogue): self
    {
        $this->catalogue = $catalogue;

        return $this;
    }

    public function getOeuvre(): ?Oeuvre
    {
        return $this->oeuvre;
    }

    public function setOeuvre(Oeuvre $oeuvre): self
    {
        $this->oeuvre = $oeuvre;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }
}
