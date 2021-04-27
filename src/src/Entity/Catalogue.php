<?php

namespace App\Entity;

use App\Repository\CatalogueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CatalogueRepository::class)
 */
class Catalogue
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
     * @ORM\Column(type="string", length=255)
     */
    private $curator;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $organizationMethod;

    /**
     * @ORM\OneToOne(targetEntity=Composer::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
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

    public function getCurator(): ?string
    {
        return $this->curator;
    }

    public function setCurator(string $curator): self
    {
        $this->curator = $curator;

        return $this;
    }

    public function getOrganizationMethod(): ?string
    {
        return $this->organizationMethod;
    }

    public function setOrganizationMethod(string $organizationMethod): self
    {
        $this->organizationMethod = $organizationMethod;

        return $this;
    }

    public function getComposer(): ?Composer
    {
        return $this->composer;
    }

    public function setComposer(Composer $composer): self
    {
        $this->composer = $composer;

        return $this;
    }

}
