<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425090344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, session_fait_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, num_tel VARCHAR(255) DEFAULT NULL, birth_date DATE DEFAULT NULL, etude VARCHAR(255) DEFAULT NULL, statut_pro VARCHAR(255) DEFAULT NULL, inscription DATE DEFAULT NULL, type_financement VARCHAR(255) DEFAULT NULL, statut_financement VARCHAR(255) DEFAULT NULL, frais_dossier VARCHAR(255) DEFAULT NULL, identifiant_po VARCHAR(255) DEFAULT NULL, mdp_po VARCHAR(255) DEFAULT NULL, email_conseille_po VARCHAR(255) DEFAULT NULL, nom_stage VARCHAR(255) DEFAULT NULL, ciretstage VARCHAR(255) DEFAULT NULL, adresse_stage VARCHAR(255) DEFAULT NULL, num_tel_stage VARCHAR(17) DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, statut_test_apt VARCHAR(255) DEFAULT NULL, INDEX IDX_6AB5B4714D05C6D1 (session_fait_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, candidat_id INT NOT NULL, fichier VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_D8698A768D0EB82 (candidat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, debut_formation DATE DEFAULT NULL, fin_formation DATE DEFAULT NULL, debut_exam DATE DEFAULT NULL, fin_exam DATE DEFAULT NULL, debut_stage DATE DEFAULT NULL, fin_stage DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B4714D05C6D1 FOREIGN KEY (session_fait_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A768D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A768D0EB82');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B4714D05C6D1');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE session');
    }
}
