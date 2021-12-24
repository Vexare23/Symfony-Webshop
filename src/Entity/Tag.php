<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="tags")
     */
    private $prod;

    public function __construct()
    {
        $this->prod = new ArrayCollection();
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

    /**
     * @return Collection|Product[]
     */
    public function getProd(): Collection
    {
        return $this->prod;
    }

    public function addProd(Product $prod): self
    {
        if (!$this->prod->contains($prod)) {
            $this->prod[] = $prod;
            $prod->addTag($this);
        }

        return $this;
    }

    public function removeProd(Product $prod): self
    {
        if ($this->prod->removeElement($prod)) {
            $prod->removeTag($this);
        }

        return $this;
    }
}
