<?php
namespace App\Entity\article;

use App\Repository\article\OrderRepository;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: OrderRepository::class)]  // <-- correct
#[ORM\Table(name: 'commandes')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_commande', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'reference', type: 'string', length: 100)]
    private ?string $reference = null;

    #[ORM\Column(name: 'date_commande', type: 'datetime')]  // because your column is timestamp
    private ?DateTimeInterface $dateCommande = null;

    #[ORM\Column(name: 'statut', type: 'string', length: 50)]
    private ?string $statut = null;

    #[ORM\Column(name: 'mode_paiement', type: 'string', length: 50, nullable: true)]
    private ?string $modePaiement = null;

    #[ORM\Column(name: 'adresse_livraison', type: 'string', length: 255, nullable: true)]
    private ?string $adresseLivraison = null;

    #[ORM\Column(name: 'montant_total', type: 'decimal', precision: 10, scale: 2)]
    private ?float $montantTotal = null;

    #[ORM\Column(name: 'frais_livraison', type: 'decimal', precision: 10, scale: 2, nullable: true, options: ['default' => 0])]
    private ?float $fraisLivraison = null;

    #[ORM\Column(name: 'id_user', type: 'integer', nullable: true)]
    private ?int $idUser = null;

    // Getters and Setters (keep the same)
    public function getId(): ?int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }
    public function getReference(): ?string { return $this->reference; }
    public function setReference(string $reference): self { $this->reference = $reference; return $this; }
    public function getDateCommande(): ?DateTimeInterface { return $this->dateCommande; }
    public function setDateCommande(DateTimeInterface $dateCommande): self { $this->dateCommande = $dateCommande; return $this; }
    public function getStatut(): ?string { return $this->statut; }
    public function setStatut(string $statut): self { $this->statut = $statut; return $this; }
    public function getModePaiement(): ?string { return $this->modePaiement; }
    public function setModePaiement(?string $modePaiement): self { $this->modePaiement = $modePaiement; return $this; }
    public function getAdresseLivraison(): ?string { return $this->adresseLivraison; }
    public function setAdresseLivraison(?string $adresseLivraison): self { $this->adresseLivraison = $adresseLivraison; return $this; }
    public function getMontantTotal(): ?float { return $this->montantTotal; }
    public function setMontantTotal(float $montantTotal): self { $this->montantTotal = $montantTotal; return $this; }
    public function getFraisLivraison(): ?float { return $this->fraisLivraison; }
    public function setFraisLivraison(?float $fraisLivraison): self { $this->fraisLivraison = $fraisLivraison; return $this; }
    public function getIdUser(): ?int { return $this->idUser; }
    public function setIdUser(?int $idUser): self { $this->idUser = $idUser; return $this; }
}