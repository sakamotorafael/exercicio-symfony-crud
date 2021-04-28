<?php

namespace App\Entity;

use App\Repository\OeuvreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tonality;


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
     * @ORM\ManyToOne(targetEntity=Composer::class, inversedBy="oeuvre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $composer;

    /**
     * @ORM\OneToMany(targetEntity=Piece::class, mappedBy="oeuvre", orphanRemoval=true)
     */
    private $pieces;


    /**
     * @ORM\ManyToOne(targetEntity=Ensemble::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $ensemble;

    /**
     * @ORM\OneToOne(targetEntity=Catalogage::class, mappedBy="oeuvre", cascade={"persist", "remove"})
     */
    private $catalogage;


    public function __construct()
    {
        $this->pieces = new ArrayCollection();

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

    public function getOpus(): ?int
    {
        return $this->opus;
    }

    public function setOpus(?int $opus): self
    {
        $this->opus = $opus;

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

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getComposer(): ?Composer
    {
        return $this->composer;
    }

    public function setComposer(?Composer $composer): self
    {
        $this->composer = $composer;

        return $this;
    }

    /**
     * @return Collection|Piece[]
     */
    public function getPieces(): Collection
    {
        return $this->pieces;
    }

    public function addPiece(Piece $piece): self
    {
        if (!$this->pieces->contains($piece)) {
            $this->pieces[] = $piece;
            $piece->setOeuvre($this);
        }

        return $this;
    }

    public function removePiece(Piece $piece): self
    {
        if ($this->pieces->removeElement($piece)) {
            // set the owning side to null (unless already changed)
            if ($piece->getOeuvre() === $this) {
                $piece->setOeuvre(null);
            }
        }

        return $this;
    }

    public function getEnsemble(): ?Ensemble
    {
        return $this->ensemble;
    }

    public function setEnsemble(?Ensemble $ensemble): self
    {
        $this->ensemble = $ensemble;

        return $this;
    }

    public function getCatalogage(): ?Catalogage
    {
        return $this->catalogage;
    }

    public function setCatalogage(Catalogage $catalogage): self
    {
        // set the owning side of the relation if necessary
        if ($catalogage->getOeuvre() !== $this) {
            $catalogage->setOeuvre($this);
        }

        $this->catalogage = $catalogage;

        return $this;
    }

}
