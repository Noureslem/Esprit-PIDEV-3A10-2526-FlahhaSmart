<?php
// src/Entity/article/OrderLine.php

namespace App\Entity\article;

use App\Repository\article\OrderLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderLineRepository::class)]
#[ORM\Table(name: 'commande_lignes')]
class OrderLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderLines')]
    #[ORM\JoinColumn(referencedColumnName: 'id_commande', nullable: false, onDelete: 'CASCADE')]
    private Order $order;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(referencedColumnName: 'id_article', nullable: false)]
    private Article $article;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $priceAtOrder;

    // Getters & setters
    public function getId(): ?int { return $this->id; }

    public function getOrder(): Order { return $this->order; }
    public function setOrder(?Order $order): self { $this->order = $order; return $this; }

    public function getArticle(): Article { return $this->article; }
    public function setArticle(?Article $article): self { $this->article = $article; return $this; }

    public function getQuantity(): int { return $this->quantity; }
    public function setQuantity(int $quantity): self { $this->quantity = $quantity; return $this; }

    public function getPriceAtOrder(): string { return $this->priceAtOrder; }
    public function setPriceAtOrder(float|string $priceAtOrder): self
    {
        $this->priceAtOrder = (string) $priceAtOrder;
        return $this;
    }

    public function getSubtotal(): float
    {
        return $this->quantity * (float) $this->priceAtOrder;
    }
}