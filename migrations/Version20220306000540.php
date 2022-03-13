<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220306000540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, nom_document VARCHAR(255) NOT NULL, document_name VARCHAR(255) NOT NULL, document_size INT NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, diplome_acces VARCHAR(255) NOT NULL, specialite VARCHAR(255) NOT NULL, univ_delivre_diplome VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, lieu_obtention_diplome VARCHAR(255) NOT NULL, date_obtention_diplome VARCHAR(255) NOT NULL, theme_recherche VARCHAR(255) NOT NULL, mention VARCHAR(255) NOT NULL, avis_directeur_theses VARCHAR(255) DEFAULT NULL, avis_responsable_labo VARCHAR(255) DEFAULT NULL, avis_responsable_doctorat VARCHAR(255) DEFAULT NULL, avis_directeur_ecole_doctoral VARCHAR(255) DEFAULT NULL, avis_chef_ecole_rattache VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_3D48E0377E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement_doctoral (id INT AUTO_INCREMENT NOT NULL, chef_etablissement_id INT NOT NULL, formation_doctorale_id INT DEFAULT NULL, nom_etablissement VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C0F4D834C810FC9C (chef_etablissement_id), INDEX IDX_C0F4D8346DC20685 (formation_doctorale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT NOT NULL, num_carte_etudiant VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_doctorale (id INT AUTO_INCREMENT NOT NULL, responsable_id INT NOT NULL, labo_rattache_id INT NOT NULL, dossier_id INT DEFAULT NULL, nom_formation VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_690CA78353C59D72 (responsable_id), INDEX IDX_690CA7831E79E76 (labo_rattache_id), INDEX IDX_690CA783611C0C56 (dossier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE laboratoire (id INT AUTO_INCREMENT NOT NULL, responsable_id INT NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C4AD03C353C59D72 (responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT NOT NULL, ecole_rattache_formation_id INT DEFAULT NULL, grade VARCHAR(255) NOT NULL, INDEX IDX_17A55299A8FF483B (ecole_rattache_formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, birth_date DATETIME NOT NULL, birth_place VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dossier ADD CONSTRAINT FK_3D48E0377E3C61F9 FOREIGN KEY (owner_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE etablissement_doctoral ADD CONSTRAINT FK_C0F4D834C810FC9C FOREIGN KEY (chef_etablissement_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE etablissement_doctoral ADD CONSTRAINT FK_C0F4D8346DC20685 FOREIGN KEY (formation_doctorale_id) REFERENCES formation_doctorale (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_doctorale ADD CONSTRAINT FK_690CA78353C59D72 FOREIGN KEY (responsable_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE formation_doctorale ADD CONSTRAINT FK_690CA7831E79E76 FOREIGN KEY (labo_rattache_id) REFERENCES laboratoire (id)');
        $this->addSql('ALTER TABLE formation_doctorale ADD CONSTRAINT FK_690CA783611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
        $this->addSql('ALTER TABLE laboratoire ADD CONSTRAINT FK_C4AD03C353C59D72 FOREIGN KEY (responsable_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299A8FF483B FOREIGN KEY (ecole_rattache_formation_id) REFERENCES formation_doctorale (id)');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_doctorale DROP FOREIGN KEY FK_690CA783611C0C56');
        $this->addSql('ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E0377E3C61F9');
        $this->addSql('ALTER TABLE etablissement_doctoral DROP FOREIGN KEY FK_C0F4D8346DC20685');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299A8FF483B');
        $this->addSql('ALTER TABLE formation_doctorale DROP FOREIGN KEY FK_690CA7831E79E76');
        $this->addSql('ALTER TABLE etablissement_doctoral DROP FOREIGN KEY FK_C0F4D834C810FC9C');
        $this->addSql('ALTER TABLE formation_doctorale DROP FOREIGN KEY FK_690CA78353C59D72');
        $this->addSql('ALTER TABLE laboratoire DROP FOREIGN KEY FK_C4AD03C353C59D72');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3BF396750');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299BF396750');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE dossier');
        $this->addSql('DROP TABLE etablissement_doctoral');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE formation_doctorale');
        $this->addSql('DROP TABLE laboratoire');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
