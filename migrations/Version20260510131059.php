<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260510131059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id_article INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, qr_code_filename VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, categorie VARCHAR(100) DEFAULT NULL, prix NUMERIC(10, 2) NOT NULL, stock INT NOT NULL, poids DOUBLE PRECISION DEFAULT NULL, unite VARCHAR(20) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, id_user INT DEFAULT NULL, PRIMARY KEY (id_article)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE commande_lignes (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, price_at_order NUMERIC(10, 2) NOT NULL, order_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_6DBC169F8D9F6D38 (order_id), INDEX IDX_6DBC169F7294869C (article_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE commandes (id_commande INT AUTO_INCREMENT NOT NULL, reference VARCHAR(100) NOT NULL, date_commande DATETIME NOT NULL, statut VARCHAR(50) NOT NULL, mode_paiement VARCHAR(50) DEFAULT NULL, adresse_livraison VARCHAR(255) DEFAULT NULL, montant_total NUMERIC(10, 2) NOT NULL, frais_livraison NUMERIC(10, 2) DEFAULT 0, id_user INT DEFAULT NULL, PRIMARY KEY (id_commande)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE commentaires (id_commentaire INT AUTO_INCREMENT NOT NULL, contenu LONGTEXT NOT NULL, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, statut VARCHAR(10) DEFAULT \'actif\' NOT NULL, sentiment VARCHAR(10) DEFAULT NULL, modere_ia TINYINT DEFAULT 0, flagge TINYINT DEFAULT 0, id_thread INT DEFAULT NULL, id_user INT DEFAULT NULL, INDEX IDX_D9BEC0C41717F96E (id_thread), INDEX IDX_D9BEC0C46B3CA4B (id_user), PRIMARY KEY (id_commentaire)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(100) NOT NULL, etat VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE jaime (id_jaime INT AUTO_INCREMENT NOT NULL, date_jaime DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, id_thread INT DEFAULT NULL, id_user INT DEFAULT NULL, INDEX IDX_3CB778051717F96E (id_thread), INDEX IDX_3CB778056B3CA4B (id_user), PRIMARY KEY (id_jaime)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE notifications (id_notif INT AUTO_INCREMENT NOT NULL, message VARCHAR(500) NOT NULL, type VARCHAR(20) NOT NULL, lu TINYINT DEFAULT 0 NOT NULL, date_notif DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, id_user INT DEFAULT NULL, INDEX IDX_6000B0D36B3CA4B (id_user), PRIMARY KEY (id_notif)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, type_operation VARCHAR(100) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, statut VARCHAR(50) NOT NULL, equipement_id INT NOT NULL, INDEX IDX_1981A66D806F0F5C (equipement_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE reputation (id_rep INT AUTO_INCREMENT NOT NULL, points INT DEFAULT 0 NOT NULL, badge VARCHAR(20) DEFAULT NULL, id_user INT DEFAULT NULL, INDEX IDX_CA177A5D6B3CA4B (id_user), PRIMARY KEY (id_rep)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE threads (id_thread INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_update DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, statut VARCHAR(10) DEFAULT \'actif\' NOT NULL, sentiment VARCHAR(10) DEFAULT NULL, tags VARCHAR(500) DEFAULT NULL, id_user INT DEFAULT NULL, INDEX IDX_6F8E3DDD6B3CA4B (id_user), PRIMARY KEY (id_thread)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE todo (NomTache VARCHAR(255) NOT NULL, Tache VARCHAR(255) NOT NULL, Statut VARCHAR(20) NOT NULL, PRIMARY KEY (NomTache, Tache)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) DEFAULT NULL, email VARCHAR(180) NOT NULL, telephone VARCHAR(20) DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(50) NOT NULL, actif TINYINT NOT NULL, created_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE votes (id_vote INT AUTO_INCREMENT NOT NULL, type_vote VARCHAR(5) NOT NULL, date_vote DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, id_thread INT DEFAULT NULL, id_user INT DEFAULT NULL, INDEX IDX_518B7ACF1717F96E (id_thread), INDEX IDX_518B7ACF6B3CA4B (id_user), PRIMARY KEY (id_vote)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE commande_lignes ADD CONSTRAINT FK_6DBC169F8D9F6D38 FOREIGN KEY (order_id) REFERENCES commandes (id_commande) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_lignes ADD CONSTRAINT FK_6DBC169F7294869C FOREIGN KEY (article_id) REFERENCES articles (id_article)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C41717F96E FOREIGN KEY (id_thread) REFERENCES threads (id_thread)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C46B3CA4B FOREIGN KEY (id_user) REFERENCES users (id)');
        $this->addSql('ALTER TABLE jaime ADD CONSTRAINT FK_3CB778051717F96E FOREIGN KEY (id_thread) REFERENCES threads (id_thread)');
        $this->addSql('ALTER TABLE jaime ADD CONSTRAINT FK_3CB778056B3CA4B FOREIGN KEY (id_user) REFERENCES users (id)');
        $this->addSql('ALTER TABLE notifications ADD CONSTRAINT FK_6000B0D36B3CA4B FOREIGN KEY (id_user) REFERENCES users (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE reputation ADD CONSTRAINT FK_CA177A5D6B3CA4B FOREIGN KEY (id_user) REFERENCES users (id)');
        $this->addSql('ALTER TABLE threads ADD CONSTRAINT FK_6F8E3DDD6B3CA4B FOREIGN KEY (id_user) REFERENCES users (id)');
        $this->addSql('ALTER TABLE votes ADD CONSTRAINT FK_518B7ACF1717F96E FOREIGN KEY (id_thread) REFERENCES threads (id_thread)');
        $this->addSql('ALTER TABLE votes ADD CONSTRAINT FK_518B7ACF6B3CA4B FOREIGN KEY (id_user) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_lignes DROP FOREIGN KEY FK_6DBC169F8D9F6D38');
        $this->addSql('ALTER TABLE commande_lignes DROP FOREIGN KEY FK_6DBC169F7294869C');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C41717F96E');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C46B3CA4B');
        $this->addSql('ALTER TABLE jaime DROP FOREIGN KEY FK_3CB778051717F96E');
        $this->addSql('ALTER TABLE jaime DROP FOREIGN KEY FK_3CB778056B3CA4B');
        $this->addSql('ALTER TABLE notifications DROP FOREIGN KEY FK_6000B0D36B3CA4B');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D806F0F5C');
        $this->addSql('ALTER TABLE reputation DROP FOREIGN KEY FK_CA177A5D6B3CA4B');
        $this->addSql('ALTER TABLE threads DROP FOREIGN KEY FK_6F8E3DDD6B3CA4B');
        $this->addSql('ALTER TABLE votes DROP FOREIGN KEY FK_518B7ACF1717F96E');
        $this->addSql('ALTER TABLE votes DROP FOREIGN KEY FK_518B7ACF6B3CA4B');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE commande_lignes');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE jaime');
        $this->addSql('DROP TABLE notifications');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE reputation');
        $this->addSql('DROP TABLE threads');
        $this->addSql('DROP TABLE todo');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE votes');
    }
}
