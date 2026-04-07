<?php

namespace App\Entity;

use App\Repository\OperationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OperationRepository::class)]
class Operation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_user = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Le type d\'opération est obligatoire.')]
    #[Assert\Length(min: 5, minMessage: 'Le type doit contenir au moins {{ limit }} caractères.')]
    #[Assert\Regex(
        pattern: '/^[\p{L}0-9 ]+$/u',
        message: 'Le type ne doit pas contenir de caractères spéciaux.'
    )]
    private ?string $type_operation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull(message: 'La date de début est requise.')]
    #[Assert\GreaterThanOrEqual(
        value: 'today',
        message: 'La date de début ne peut pas être dans le passé.'
    )]
    private ?\DateTime $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull(message: 'La date de fin est requise.')]
    #[Assert\GreaterThanOrEqual(
        propertyPath: 'date_debut',
        message: 'La date de fin ne peut pas être avant la date de début.'
    )]
    private ?\DateTime $date_fin = null;

    #[ORM\Column(length: 50)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'operations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipement $equipement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getTypeOperation(): ?string
    {
        return $this->type_operation;
    }

    public function setTypeOperation(string $type_operation): static
    {
        $this->type_operation = $type_operation;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
{
    return $this->date_debut;
}

public function setDateDebut(?\DateTimeInterface $date_debut): static
{
    $this->date_debut = $date_debut;
    return $this;
}

public function getDateFin(): ?\DateTimeInterface
{
    return $this->date_fin;
}

public function setDateFin(?\DateTimeInterface $date_fin): static
{
    $this->date_fin = $date_fin;
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

    public function getEquipement(): ?Equipement
    {
        return $this->equipement;
    }

    public function setEquipement(?Equipement $equipement): static
    {
        $this->equipement = $equipement;

        return $this;
    }
}
