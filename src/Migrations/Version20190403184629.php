<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403184629 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, datenaissance DATETIME NOT NULL, cin VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, projets VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, employ_id INT NOT NULL, service_id INT DEFAULT NULL, nomtache VARCHAR(255) NOT NULL, datedebut DATETIME NOT NULL, datefin DATETIME NOT NULL, INDEX IDX_93872075BC18698D (employ_id), INDEX IDX_93872075ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache_stock (tache_id INT NOT NULL, stock_id INT NOT NULL, INDEX IDX_D4FB81A1D2235D39 (tache_id), INDEX IDX_D4FB81A1DCD6110 (stock_id), PRIMARY KEY(tache_id, stock_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, INDEX IDX_29A5EC27BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_fournisseur (produit_id INT NOT NULL, fournisseur_id INT NOT NULL, INDEX IDX_48868EB6F347EFB (produit_id), INDEX IDX_48868EB6670C757F (fournisseur_id), PRIMARY KEY(produit_id, fournisseur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_facture (id INT AUTO_INCREMENT NOT NULL, facture_id INT DEFAULT NULL, qte DOUBLE PRECISION NOT NULL, prixunitaire DOUBLE PRECISION NOT NULL, INDEX IDX_611F5A297F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_B6BD307FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, nommetier VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nomservice VARCHAR(255) NOT NULL, datedebut DATETIME NOT NULL, datefin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_user (service_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_43D062A5ED5CA9E6 (service_id), INDEX IDX_43D062A5A76ED395 (user_id), PRIMARY KEY(service_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, nomprojet VARCHAR(255) NOT NULL, datefin DATETIME NOT NULL, datedebut DATETIME NOT NULL, budget DOUBLE PRECISION NOT NULL, avance DOUBLE PRECISION DEFAULT NULL, INDEX IDX_50159CA919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caisse (id INT AUTO_INCREMENT NOT NULL, totale DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, tache_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, titre VARCHAR(255) DEFAULT NULL, datecom DATETIME NOT NULL, INDEX IDX_67F068BCD2235D39 (tache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, client_id INT DEFAULT NULL, numero INT NOT NULL, desingation VARCHAR(255) NOT NULL, INDEX IDX_FE866410670C757F (fournisseur_id), INDEX IDX_FE86641019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_tache (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, tache_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_6C21DF9EA76ED395 (user_id), INDEX IDX_6C21DF9ED2235D39 (tache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, datenaissance DATETIME NOT NULL, role VARCHAR(255) NOT NULL, cin VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_metier (user_id INT NOT NULL, metier_id INT NOT NULL, INDEX IDX_34F216B1A76ED395 (user_id), INDEX IDX_34F216B1ED16FA20 (metier_id), PRIMARY KEY(user_id, metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, qte INT NOT NULL, datemaj DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_produit (stock_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_3003FC84DCD6110 (stock_id), INDEX IDX_3003FC84F347EFB (produit_id), PRIMARY KEY(stock_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caisse_log (id INT AUTO_INCREMENT NOT NULL, projet_id INT DEFAULT NULL, stock_id INT DEFAULT NULL, typetransaction VARCHAR(255) NOT NULL, date DATE NOT NULL, somme DOUBLE PRECISION NOT NULL, INDEX IDX_BF121AB5C18272 (projet_id), INDEX IDX_BF121AB5DCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075BC18698D FOREIGN KEY (employ_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE tache_stock ADD CONSTRAINT FK_D4FB81A1D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tache_stock ADD CONSTRAINT FK_D4FB81A1DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit_fournisseur ADD CONSTRAINT FK_48868EB6F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_fournisseur ADD CONSTRAINT FK_48868EB6670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ligne_facture ADD CONSTRAINT FK_611F5A297F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE service_user ADD CONSTRAINT FK_43D062A5ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_user ADD CONSTRAINT FK_43D062A5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE message_tache ADD CONSTRAINT FK_6C21DF9EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message_tache ADD CONSTRAINT FK_6C21DF9ED2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE user_metier ADD CONSTRAINT FK_34F216B1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_metier ADD CONSTRAINT FK_34F216B1ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock_produit ADD CONSTRAINT FK_3003FC84DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock_produit ADD CONSTRAINT FK_3003FC84F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caisse_log ADD CONSTRAINT FK_BF121AB5C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE caisse_log ADD CONSTRAINT FK_BF121AB5DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA919EB6921');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641019EB6921');
        $this->addSql('ALTER TABLE tache_stock DROP FOREIGN KEY FK_D4FB81A1D2235D39');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCD2235D39');
        $this->addSql('ALTER TABLE message_tache DROP FOREIGN KEY FK_6C21DF9ED2235D39');
        $this->addSql('ALTER TABLE produit_fournisseur DROP FOREIGN KEY FK_48868EB6F347EFB');
        $this->addSql('ALTER TABLE stock_produit DROP FOREIGN KEY FK_3003FC84F347EFB');
        $this->addSql('ALTER TABLE user_metier DROP FOREIGN KEY FK_34F216B1ED16FA20');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075ED5CA9E6');
        $this->addSql('ALTER TABLE service_user DROP FOREIGN KEY FK_43D062A5ED5CA9E6');
        $this->addSql('ALTER TABLE caisse_log DROP FOREIGN KEY FK_BF121AB5C18272');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE ligne_facture DROP FOREIGN KEY FK_611F5A297F2DEE08');
        $this->addSql('ALTER TABLE produit_fournisseur DROP FOREIGN KEY FK_48868EB6670C757F');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410670C757F');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075BC18698D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE service_user DROP FOREIGN KEY FK_43D062A5A76ED395');
        $this->addSql('ALTER TABLE message_tache DROP FOREIGN KEY FK_6C21DF9EA76ED395');
        $this->addSql('ALTER TABLE user_metier DROP FOREIGN KEY FK_34F216B1A76ED395');
        $this->addSql('ALTER TABLE tache_stock DROP FOREIGN KEY FK_D4FB81A1DCD6110');
        $this->addSql('ALTER TABLE stock_produit DROP FOREIGN KEY FK_3003FC84DCD6110');
        $this->addSql('ALTER TABLE caisse_log DROP FOREIGN KEY FK_BF121AB5DCD6110');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE tache_stock');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_fournisseur');
        $this->addSql('DROP TABLE ligne_facture');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_user');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE caisse');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE message_tache');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_metier');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE stock_produit');
        $this->addSql('DROP TABLE caisse_log');
    }
}
