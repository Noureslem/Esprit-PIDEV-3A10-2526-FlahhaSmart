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
    #[ORM\JoinColumn(name: 'id_commande', referencedColumnName: 'id_commande', nullable: false)]
    private ?Order $order = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'id_article', referencedColumnName: 'id_article', nullable: false)]
    private ?Article $article = null;

    #[ORM\Column(type: 'integer')]
    private ?int $quantity = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?float $priceAtOrder = null; // prix figé au moment de la commande

    // Getters & setters
    public function getId(): ?int { return $this->id; }
    public function getOrder(): ?Order { return $this->order; }
    public function setOrder(?Order $order): self { $this->order = $order; return $this; }
    public function getArticle(): ?Article { return $this->article; }
    public function setArticle(?Article $article): self { $this->article = $article; return $this; }
    public function getQuantity(): ?int { return $this->quantity; }
    public function setQuantity(int $quantity): self { $this->quantity = $quantity; return $this; }
    public function getPriceAtOrder(): ?float { return $this->priceAtOrder; }
    public function setPriceAtOrder(float $priceAtOrder): self { $this->priceAtOrder = $priceAtOrder; return $this; }

    // Calcul du sous-total pour cette ligne
    public function getSubtotal(): float
    {
        return $this->quantity * $this->priceAtOrder;
    }
}