<?php
namespace App\Entity\article;

use App\Repository\article\ArticleRepository;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]  // <-- correct
#[ORM\Table(name: 'articles')]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_article', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'nom', type: 'string', length: 100)]
    private ?string $nom = null;

    #[ORM\Column(name: 'description', type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(name: 'categorie', type: 'string', length: 100, nullable: true)]
    private ?string $categorie = null;

    #[ORM\Column(name: 'prix', type: 'decimal', precision: 10, scale: 2)]
    private ?float $prix = null;

    #[ORM\Column(name: 'stock', type: 'integer')]
    private ?int $stock = null;

    #[ORM\Column(name: 'poids', type: 'float', nullable: true)]
    private ?float $poids = null;

    #[ORM\Column(name: 'unite', type: 'string', length: 20, nullable: true)]
    private ?string $unite = null;

    #[ORM\Column(name: 'image_url', type: 'string', length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column(name: 'date_ajout', type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?DateTimeImmutable $dateAjout = null;

    #[ORM\Column(name: 'id_user', type: 'integer', nullable: true)]
    private ?int $idUser = null;

    public function __construct()
    {
        $this->dateAjout = new DateTimeImmutable();
    }

    // Getters and Setters (keep the same as before)
    public function getId(): ?int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }
    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }
    public function getCategorie(): ?string { return $this->categorie; }
    public function setCategorie(?string $categorie): self { $this->categorie = $categorie; return $this; }
    public function getPrix(): ?float { return $this->prix; }
    public function setPrix(float $prix): self { $this->prix = $prix; return $this; }
    public function getStock(): ?int { return $this->stock; }
    public function setStock(int $stock): self { $this->stock = $stock; return $this; }
    public function getPoids(): ?float { return $this->poids; }
    public function setPoids(?float $poids): self { $this->poids = $poids; return $this; }
    public function getUnite(): ?string { return $this->unite; }
    public function setUnite(?string $unite): self { $this->unite = $unite; return $this; }
    public function getImageUrl(): ?string { return $this->imageUrl; }
    public function setImageUrl(?string $imageUrl): self { $this->imageUrl = $imageUrl; return $this; }
    public function getDateAjout(): ?DateTimeImmutable { return $this->dateAjout; }
    public function setDateAjout(DateTimeImmutable $dateAjout): self { $this->dateAjout = $dateAjout; return $this; }
    public function getIdUser(): ?int { return $this->idUser; }
    public function setIdUser(?int $idUser): self { $this->idUser = $idUser; return $this; }
}