<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks] // ← Ajoutez cette ligne importante
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $update_at = null;

    /**
     * @var Collection<int, Listing>
     */
    #[ORM\OneToMany(targetEntity: Listing::class, mappedBy: 'user_id')]
    private Collection $listings;



    // Ajoutez le constructeur pour initialiser les dates
    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->update_at = new \DateTimeImmutable();
        $this->listings = new ArrayCollection();
    }

    // Ajoutez les lifecycle callbacks
    #[ORM\PrePersist]
    public function setTimestampsOnCreate(): void
    {
        $this->created_at = new \DateTimeImmutable();
        $this->update_at = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function setTimestampsOnUpdate(): void
    {
        $this->update_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        $this->update_at = new \DateTimeImmutable(); // Mise à jour automatique
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        $this->update_at = new \DateTimeImmutable(); // Mise à jour automatique
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeImmutable $update_at): static
    {
        $this->update_at = $update_at;
        return $this;
    }

    /**
     * @return Collection<int, Listing>
     */
    public function getListings(): Collection
    {
        return $this->listings;
    }

    public function addListing(Listing $listing): static
    {
        if (!$this->listings->contains($listing)) {
            $this->listings->add($listing);
            $listing->setUserId($this);
        }

        return $this;
    }

    public function removeListing(Listing $listing): static
    {
        if ($this->listings->removeElement($listing)) {
            // set the owning side to null (unless already changed)
            if ($listing->getUserId() === $this) {
                $listing->setUserId(null);
            }
        }

        return $this;
    }
    public function __toString(): string
{
    return $this->email ?: 'Utilisateur #' . $this->id;
}

    

    
}