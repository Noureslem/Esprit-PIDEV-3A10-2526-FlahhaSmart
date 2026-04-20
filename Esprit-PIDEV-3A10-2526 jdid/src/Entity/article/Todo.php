<?php
namespace App\Entity\article;

use App\Repository\article\TodoRepository;


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoRepository::class)]  // <-- correct
#[ORM\Table(name: 'todo')]
class Todo
{
    #[ORM\Id]
    #[ORM\Column(name: 'NomTache', type: 'string', length: 255)]
    private ?string $nomTache = null;

    #[ORM\Id]
    #[ORM\Column(name: 'Tache', type: 'string', length: 255)]
    private ?string $tache = null;

    #[ORM\Column(name: 'Statut', type: 'string', length: 20)]
    private ?string $statut = null;

    // Getters and Setters
    public function getNomTache(): ?string { return $this->nomTache; }
    public function setNomTache(string $nomTache): self { $this->nomTache = $nomTache; return $this; }
    public function getTache(): ?string { return $this->tache; }
    public function setTache(string $tache): self { $this->tache = $tache; return $this; }
    public function getStatut(): ?string { return $this->statut; }
    public function setStatut(string $statut): self { $this->statut = $statut; return $this; }
}