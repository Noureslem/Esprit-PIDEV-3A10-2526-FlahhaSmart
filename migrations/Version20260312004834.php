<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260312004834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY `fk_produit_agriculteur`');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY `fk_commande_client`');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY `fk_comment_thread`');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY `fk_comment_user`');
        $this->addSql('ALTER TABLE consommation_produit DROP FOREIGN KEY `fk_consommation_user`');
        $this->addSql('ALTER TABLE jaime DROP FOREIGN KEY `jaime_ibfk_1`');
        $this->addSql('ALTER TABLE jaime DROP FOREIGN KEY `jaime_ibfk_2`');
        $this->addSql('ALTER TABLE notifications DROP FOREIGN KEY `notifications_ibfk_1`');
        $this->addSql('ALTER TABLE stock_produit DROP FOREIGN KEY `fk_stock_utilisateur`');
        $this->addSql('ALTER TABLE threads DROP FOREIGN KEY `fk_thread_user`');
        $this->addSql('ALTER TABLE votes DROP FOREIGN KEY `votes_ibfk_1`');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE consommation_produit');
        $this->addSql('DROP TABLE jaime');
        $this->addSql('DROP TABLE notifications');
        $this->addSql('DROP TABLE reputation');
        $this->addSql('DROP TABLE stock_produit');
        $this->addSql('DROP TABLE threads');
        $this->addSql('DROP TABLE todo');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE votes');
        $this->addSql('ALTER TABLE equipement MODIFY id_equipement INT NOT NULL');
        $this->addSql('ALTER TABLE equipement CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE etat etat VARCHAR(50) NOT NULL, CHANGE id_equipement id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX fk_operation_equipement ON operation');
        $this->addSql('ALTER TABLE operation MODIFY id_operation INT NOT NULL');
        $this->addSql('ALTER TABLE operation CHANGE date_debut date_debut DATE NOT NULL, CHANGE date_fin date_fin DATE NOT NULL, CHANGE statut statut VARCHAR(50) NOT NULL, CHANGE id_operation id INT AUTO_INCREMENT NOT NULL, CHANGE id_equipement equipement_id INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('CREATE INDEX IDX_1981A66D806F0F5C ON operation (equipement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id_article INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, categorie VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, prix NUMERIC(10, 2) NOT NULL, stock INT DEFAULT 0 NOT NULL, poids DOUBLE PRECISION DEFAULT NULL, unite VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, image_url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, id_user INT DEFAULT NULL, INDEX fk_produit_agriculteur (id_user), PRIMARY KEY (id_article)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commandes (id_commande INT AUTO_INCREMENT NOT NULL, reference VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, date_commande DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, statut VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, mode_paiement VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, adresse_livraison VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, montant_total NUMERIC(10, 2) NOT NULL, frais_livraison NUMERIC(10, 2) DEFAULT \'0.00\', id_user INT DEFAULT NULL, UNIQUE INDEX reference (reference), INDEX fk_commande_client (id_user), PRIMARY KEY (id_commande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commentaires (id_commentaire INT AUTO_INCREMENT NOT NULL, id_thread INT NOT NULL, id_user INT NOT NULL, contenu TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, statut VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'actif\' COLLATE `utf8mb4_0900_ai_ci`, sentiment VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'neutre\' COLLATE `utf8mb4_0900_ai_ci`, INDEX fk_comment_thread (id_thread), INDEX fk_comment_user (id_user), PRIMARY KEY (id_commentaire)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE consommation_produit (id_produit INT AUTO_INCREMENT NOT NULL, type_produit VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, surface DOUBLE PRECISION NOT NULL, quantite_utilisee DOUBLE PRECISION NOT NULL, unite VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, date_recolte DATE NOT NULL, date_utilisation DATE NOT NULL, id_user INT NOT NULL, INDEX fk_consommation_user (id_user), PRIMARY KEY (id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE jaime (id_jaime INT AUTO_INCREMENT NOT NULL, id_thread INT NOT NULL, id_user INT NOT NULL, date_jaime DATETIME DEFAULT CURRENT_TIMESTAMP, UNIQUE INDEX unique_jaime (id_thread, id_user), INDEX idx_thread (id_thread), INDEX idx_user (id_user), PRIMARY KEY (id_jaime)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE notifications (id_notif INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, message VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, type VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, lu TINYINT DEFAULT 0, date_notif DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX id_user (id_user), PRIMARY KEY (id_notif)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reputation (id_rep INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, points INT DEFAULT 0, badge VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'? Débutant\' COLLATE `utf8mb4_0900_ai_ci`, UNIQUE INDEX unique_user (id_user), PRIMARY KEY (id_rep)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stock_produit (id_produit INT AUTO_INCREMENT NOT NULL, type_produit VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, variete VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, date_debut DATE NOT NULL, date_fin_estimee DATE DEFAULT NULL, statut VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'en cours\' NOT NULL COLLATE `utf8mb4_0900_ai_ci`, id_user INT NOT NULL, INDEX fk_stock_utilisateur (id_user), PRIMARY KEY (id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE threads (id_thread INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, contenu TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, date_update DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, statut VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'actif\' COLLATE `utf8mb4_0900_ai_ci`, sentiment VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'neutre\' COLLATE `utf8mb4_0900_ai_ci`, tags VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT \'\' COLLATE `utf8mb4_0900_ai_ci`, INDEX fk_thread_user (id_user), PRIMARY KEY (id_thread)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE todo (id INT AUTO_INCREMENT NOT NULL, NomTache VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, Tache VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, Statut VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY (id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users (id_user INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, prenom VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, email VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, telephone VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ville VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, photo_profil VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, role ENUM(\'ADMINISTRATEUR\', \'AGRICULTEUR\', \'CLIENT\') CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, actif TINYINT DEFAULT 1, date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX email (email), PRIMARY KEY (id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE votes (id_vote INT AUTO_INCREMENT NOT NULL, id_thread INT NOT NULL, id_user INT NOT NULL, type_vote VARCHAR(5) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, date_vote DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX unique_vote (id_thread, id_user), INDEX IDX_518B7ACF1717F96E (id_thread), PRIMARY KEY (id_vote)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT `fk_produit_agriculteur` FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT `fk_commande_client` FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT `fk_comment_thread` FOREIGN KEY (id_thread) REFERENCES threads (id_thread) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consommation_produit ADD CONSTRAINT `fk_consommation_user` FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jaime ADD CONSTRAINT `jaime_ibfk_1` FOREIGN KEY (id_thread) REFERENCES threads (id_thread) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jaime ADD CONSTRAINT `jaime_ibfk_2` FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notifications ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock_produit ADD CONSTRAINT `fk_stock_utilisateur` FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE threads ADD CONSTRAINT `fk_thread_user` FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE votes ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (id_thread) REFERENCES threads (id_thread) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE equipement CHANGE nom nom VARCHAR(100) NOT NULL, CHANGE etat etat VARCHAR(50) DEFAULT \'libre\', CHANGE id id_equipement INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_equipement)');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D806F0F5C');
        $this->addSql('DROP INDEX IDX_1981A66D806F0F5C ON operation');
        $this->addSql('ALTER TABLE operation MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE operation CHANGE date_debut date_debut DATE DEFAULT NULL, CHANGE date_fin date_fin DATE DEFAULT NULL, CHANGE statut statut VARCHAR(50) DEFAULT \'en cours\', CHANGE id id_operation INT AUTO_INCREMENT NOT NULL, CHANGE equipement_id id_equipement INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_operation)');
        $this->addSql('CREATE INDEX fk_operation_equipement ON operation (id_equipement)');
    }
}
