<?php
namespace App\Entity\article;

use App\Repository\article\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: 'commandes')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_commande', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'reference', type: 'string', length: 100)]
    private string $reference;

    #[ORM\Column(name: 'date_commande', type: 'datetime')]
    private DateTimeInterface $dateCommande;

    #[ORM\Column(name: 'statut', type: 'string', length: 50)]
    private string $statut;

    #[ORM\Column(name: 'mode_paiement', type: 'string', length: 50, nullable: true)]
    private ?string $modePaiement = null;

    #[ORM\Column(name: 'adresse_livraison', type: 'string', length: 255, nullable: true)]
    private ?string $adresseLivraison = null;

    #[ORM\Column(name: 'montant_total', type: 'decimal', precision: 10, scale: 2)]
    private string $montantTotal;

    #[ORM\Column(name: 'frais_livraison', type: 'decimal', precision: 10, scale: 2, nullable: true, options: ['default' => 0])]
    private ?string $fraisLivraison = null;

    #[ORM\Column(name: 'id_user', type: 'integer', nullable: true)]
    private ?int $idUser = null;

    /**
     * @var Collection<int, OrderLine>
     */
    #[ORM\OneToMany(mappedBy: 'order', targetEntity: OrderLine::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $orderLines;

    public function __construct()
    {
        $this->orderLines = new ArrayCollection();
        $this->dateCommande = new \DateTime();
        $this->montantTotal = '0.00';
    }
    /**
     * @return Collection<int, OrderLine>
     */
    public function getOrderLines(): Collection
    {
        return $this->orderLines;
    }

    public function addOrderLine(OrderLine $line): self
    {
        if (!$this->orderLines->contains($line)) {
            $this->orderLines[] = $line;
            $line->setOrder($this);
        }
        return $this;
    }

    public function removeOrderLine(OrderLine $line): self
    {
        if ($this->orderLines->removeElement($line)) {
            if ($line->getOrder() === $this) {
                //$line->setOrder(null);
            }
        }
        return $this;
    }

    public function recalculateTotal(): void
    {
        $total = 0.0;
        foreach ($this->orderLines as $line) {
            $total += $line->getSubtotal();
        }
        $this->montantTotal = (string) ($total + (float)($this->fraisLivraison ?? 0));
    }

    // --- Getters & Setters ---
    public function getId(): ?int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }

    public function getReference(): string { return $this->reference; }
    public function setReference(string $reference): self { $this->reference = $reference; return $this; }

    public function getDateCommande(): DateTimeInterface { return $this->dateCommande; }
    public function setDateCommande(DateTimeInterface $dateCommande): self { $this->dateCommande = $dateCommande; return $this; }

    public function getStatut(): string { return $this->statut; }
    public function setStatut(string $statut): self { $this->statut = $statut; return $this; }

    public function getModePaiement(): ?string { return $this->modePaiement; }
    public function setModePaiement(?string $modePaiement): self { $this->modePaiement = $modePaiement; return $this; }

    public function getAdresseLivraison(): ?string { return $this->adresseLivraison; }
    public function setAdresseLivraison(?string $adresseLivraison): self { $this->adresseLivraison = $adresseLivraison; return $this; }

    public function getMontantTotal(): string { return $this->montantTotal; }
    public function setMontantTotal(float|string $montantTotal): self
    {
        $this->montantTotal = (string) $montantTotal;
        return $this;
    }

    public function getFraisLivraison(): ?string { return $this->fraisLivraison; }
    public function setFraisLivraison(float|string|null $fraisLivraison): self
    {
        $this->fraisLivraison = $fraisLivraison !== null ? (string) $fraisLivraison : null;
        return $this;
    }

    public function getIdUser(): ?int { return $this->idUser; }
    public function setIdUser(?int $idUser): self { $this->idUser = $idUser; return $this; }
}