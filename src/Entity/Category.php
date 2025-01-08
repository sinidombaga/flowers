<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, Flowers>
     */
    #[ORM\OneToMany(targetEntity: Flowers::class, mappedBy: 'category')]
    private Collection $flowers;

    public function __construct()
    {
        $this->flowers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Flowers>
     */
    public function getFlowers(): Collection
    {
        return $this->flowers;
    }

    public function addFlower(Flowers $flower): static
    {
        if (!$this->flowers->contains($flower)) {
            $this->flowers->add($flower);
            $flower->setCategory($this);
        }

        return $this;
    }

    public function removeFlower(Flowers $flower): static
    {
        if ($this->flowers->removeElement($flower)) {
            // set the owning side to null (unless already changed)
            if ($flower->getCategory() === $this) {
                $flower->setCategory(null);
            }
        }

        return $this;
    }
}
