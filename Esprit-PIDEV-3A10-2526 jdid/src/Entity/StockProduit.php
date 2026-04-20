<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: \App\Repository\StockProduitRepository::class)]
#[ORM\Table(name: 'stock_produit')]
class StockProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_produit', type: 'integer')]
    private ?int $idProduit = null;

    #[ORM\Column(name: 'type_produit', type: 'string', length: 100)]
    #[Assert\NotBlank(message: "Le type de produit est obligatoire.")]
    #[Assert\Length(max: 100, maxMessage: "Le type de produit ne doit pas dépasser {{ limit }} caractères.")]
    private ?string $typeProduit = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: "La variété est obligatoire et ne peut être vide.")]
    private ?string $variete = null;

    #[ORM\Column(name: 'date_debut', type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "La date de début est requise.")]
    #[Assert\Type("\DateTimeInterface", message: "Veuillez entrer une date valide.")]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(name: 'date_fin_estimee', type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\Type("\DateTimeInterface", message: "Veuillez entrer une date valide.")]
    #[Assert\GreaterThan(propertyPath: "dateDebut", message: "La date de fin estimée doit être strictement supérieure à la date de début.")]
    private ?\DateTimeInterface $dateFinEstimee = null;

    #[ORM\Column(type: 'string', length: 50, options: ["default" => "en cours"])]
    #[Assert\NotBlank(message: "Le statut est obligatoire.")]
    #[Assert\Choice(choices: ['en cours', 'terminé', 'en croissance'], message: "Veuillez choisir un statut valide (en cours, terminé, en croissance).")]
    private ?string $statut = 'en cours';

    #[ORM\ManyToOne(targetEntity: Users::class)]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id_user', nullable: false)]
    #[Assert\NotNull(message: "L'agriculteur en charge doit être spécifié.")]
    private ?Users $user = null;

    #[ORM\Column(name: 'code_qr', type: 'string', length: 250, nullable: true)]
    private ?string $codeQr = null;

    #[ORM\OneToMany(mappedBy: 'stockProduit', targetEntity: ConsommationProduit::class, cascade: ['remove'])]
    private Collection $consommations;

    public function __construct()
    {
        $this->consommations = new ArrayCollection();
    }

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function getTypeProduit(): ?string
    {
        return $this->typeProduit;
    }

    public function setTypeProduit(string $typeProduit): static
    {
        $this->typeProduit = $typeProduit;
        return $this;
    }

    public function getVariete(): ?string
    {
        return $this->variete;
    }

    public function setVariete(string $variete): static
    {
        $this->variete = $variete;
        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    public function getDateFinEstimee(): ?\DateTimeInterface
    {
        return $this->dateFinEstimee;
    }

    public function setDateFinEstimee(?\DateTimeInterface $dateFinEstimee): static
    {
        $this->dateFinEstimee = $dateFinEstimee;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;
        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;
        return $this;
    }

    public function getCodeQr(): ?string
    {
        return $this->codeQr;
    }

    public function setCodeQr(?string $codeQr): static
    {
        $this->codeQr = $codeQr;
        return $this;
    }

    /**
     * @return Collection<int, ConsommationProduit>
     */
    public function getConsommations(): Collection
    {
        return $this->consommations;
    }

    public function addConsommation(ConsommationProduit $consommation): static
    {
        if (!$this->consommations->contains($consommation)) {
            $this->consommations->add($consommation);
            $consommation->setStockProduit($this);
        }

        return $this;
    }

    public function removeConsommation(ConsommationProduit $consommation): static
    {
        if ($this->consommations->removeElement($consommation)) {
            // set the owning side to null (unless already changed)
            if ($consommation->getStockProduit() === $this) {
                $consommation->setStockProduit(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->typeProduit . ' - ' . $this->variete;
    }

    #[Assert\Callback]
    public function validateDates(ExecutionContextInterface $context, mixed $payload): void
    {
        if ($this->dateDebut !== null && $this->dateFinEstimee !== null) {
            if ($this->dateDebut >= $this->dateFinEstimee) {
                $context->buildViolation("La date de début doit toujours être inférieure à la date de fin estimée.")
                    ->atPath('dateDebut')
                    ->addViolation();
            }
        }
    }
}
