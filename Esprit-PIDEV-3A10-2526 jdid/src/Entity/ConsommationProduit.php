<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: \App\Repository\ConsommationProduitRepository::class)]
#[ORM\Table(name: 'consommation_produit')]
class ConsommationProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_produit', type: 'integer')]
    private ?int $idProduit = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank(message: "La surface est obligatoire.")]
    #[Assert\Positive(message: "La surface (en hectare/m2) doit être un nombre strictement positif.")]
    private ?float $surface = null;

    #[ORM\Column(name: 'quantite_utilisee', type: 'float')]
    #[Assert\NotBlank(message: "La quantité utilisée est obligatoire.")]
    #[Assert\PositiveOrZero(message: "La quantité utilisée ne peut pas être un nombre négatif.")]
    private ?float $quantiteUtilisee = null;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank(message: "L'unité est obligatoire.")]
    #[Assert\Length(max: 20, maxMessage: "L'unité ne doit pas dépasser {{ limit }} caractères.")]
    private ?string $unite = null;

    #[ORM\Column(name: 'date_recolte', type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "La date de récolte est requise.")]
    #[Assert\Type("\DateTimeInterface", message: "Veuillez entrer une date valide.")]
    private ?\DateTimeInterface $dateRecolte = null;

    #[ORM\Column(name: 'date_utilisation', type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "La date d'utilisation est requise.")]
    #[Assert\Type("\DateTimeInterface", message: "Veuillez entrer une date valide.")]
    #[Assert\GreaterThanOrEqual(propertyPath: "dateRecolte", message: "La date d'utilisation ne peut pas précéder la date de récolte.")]
    private ?\DateTimeInterface $dateUtilisation = null;

    #[ORM\ManyToOne(targetEntity: StockProduit::class, inversedBy: 'consommations')]
    #[ORM\JoinColumn(name: 'id_stock_produit', referencedColumnName: 'id_produit', nullable: false)]
    #[Assert\NotNull(message: "Le produit de stock associé doit être spécifié.")]
    private ?StockProduit $stockProduit = null;

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): static
    {
        $this->surface = $surface;
        return $this;
    }

    public function getQuantiteUtilisee(): ?float
    {
        return $this->quantiteUtilisee;
    }

    public function setQuantiteUtilisee(float $quantiteUtilisee): static
    {
        $this->quantiteUtilisee = $quantiteUtilisee;
        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(string $unite): static
    {
        $this->unite = $unite;
        return $this;
    }

    public function getDateRecolte(): ?\DateTimeInterface
    {
        return $this->dateRecolte;
    }

    public function setDateRecolte(?\DateTimeInterface $dateRecolte): static
    {
        $this->dateRecolte = $dateRecolte;
        return $this;
    }

    public function getDateUtilisation(): ?\DateTimeInterface
    {
        return $this->dateUtilisation;
    }

    public function setDateUtilisation(?\DateTimeInterface $dateUtilisation): static
    {
        $this->dateUtilisation = $dateUtilisation;
        return $this;
    }

    public function getStockProduit(): ?StockProduit
    {
        return $this->stockProduit;
    }

    public function setStockProduit(?StockProduit $stockProduit): static
    {
        $this->stockProduit = $stockProduit;
        return $this;
    }

    #[Assert\Callback]
    public function validateDates(ExecutionContextInterface $context, mixed $payload): void
    {
        if ($this->dateRecolte !== null && $this->dateUtilisation !== null) {
            if ($this->dateRecolte > $this->dateUtilisation) {
                $context->buildViolation("La date de récolte doit toujours être inférieure ou égale à la date d'utilisation.")
                    ->atPath('dateRecolte')
                    ->addViolation();
            }
        }
    }
}
