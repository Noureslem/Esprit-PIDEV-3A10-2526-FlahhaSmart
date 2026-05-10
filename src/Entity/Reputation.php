<?php

namespace App\Entity;

use App\Repository\ReputationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReputationRepository::class)]
#[ORM\Table(name: 'reputation')]
class Reputation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_rep', type: 'integer')]
    private ?int $idRep = null;

    #[ORM\ManyToOne(targetEntity: Users::class)]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id')]
    private ?Users $user = null;

    #[ORM\Column(name: 'points', type: 'integer', options: ['default' => 0])]
    private int $points = 0;

    #[ORM\Column(name: 'badge', type: 'string', length: 20, nullable: true)]
    private ?string $badge = null;

    // Getters / Setters

    public function getIdRep(): ?int { return $this->idRep; }

    public function getUser(): ?Users { return $this->user; }
    public function setUser(?Users $user): self { $this->user = $user; return $this; }

    public function getPoints(): int { return $this->points; }
    public function setPoints(int $points): self { $this->points = $points; return $this; }

    public function getBadge(): ?string { return $this->badge; }
    public function setBadge(?string $badge): self { $this->badge = $badge; return $this; }
}
