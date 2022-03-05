<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220304224812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE document_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE dossier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE etablissement_doctoral_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE formation_doctorale_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE laboratoire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE document (id INT NOT NULL, nom_document VARCHAR(255) NOT NULL, document_name VARCHAR(255) NOT NULL, document_size INT NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE dossier (id INT NOT NULL, owner_id INT NOT NULL, diplome_acces VARCHAR(255) NOT NULL, specialite VARCHAR(255) NOT NULL, univ_delivre_diplome VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, lieu_obtention_diplome VARCHAR(255) NOT NULL, date_obtention_diplome VARCHAR(255) NOT NULL, theme_recherche VARCHAR(255) NOT NULL, mention VARCHAR(255) NOT NULL, avis_directeur_theses VARCHAR(255) DEFAULT NULL, avis_responsable_labo VARCHAR(255) DEFAULT NULL, avis_responsable_doctorat VARCHAR(255) DEFAULT NULL, avis_directeur_ecole_doctoral VARCHAR(255) DEFAULT NULL, avis_chef_ecole_rattache VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D48E0377E3C61F9 ON dossier (owner_id)');
        $this->addSql('CREATE TABLE etablissement_doctoral (id INT NOT NULL, chef_etablissement_id INT NOT NULL, formation_doctorale_id INT DEFAULT NULL, nom_etablissement VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0F4D834C810FC9C ON etablissement_doctoral (chef_etablissement_id)');
        $this->addSql('CREATE INDEX IDX_C0F4D8346DC20685 ON etablissement_doctoral (formation_doctorale_id)');
        $this->addSql('CREATE TABLE etudiant (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, birth_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, birth_place VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, num_carte_etudiant VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E3E7927C74 ON etudiant (email)');
        $this->addSql('CREATE TABLE formation_doctorale (id INT NOT NULL, responsable_id INT NOT NULL, nom_formation VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_690CA78353C59D72 ON formation_doctorale (responsable_id)');
        $this->addSql('CREATE TABLE laboratoire (id INT NOT NULL, responsable_id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4AD03C353C59D72 ON laboratoire (responsable_id)');
        $this->addSql('CREATE TABLE professeur (id INT NOT NULL, ecole_rattache_formation_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, birth_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, birth_place VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, grade VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_17A55299E7927C74 ON professeur (email)');
        $this->addSql('CREATE INDEX IDX_17A55299A8FF483B ON professeur (ecole_rattache_formation_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, birth_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, birth_place VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE dossier ADD CONSTRAINT FK_3D48E0377E3C61F9 FOREIGN KEY (owner_id) REFERENCES etudiant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etablissement_doctoral ADD CONSTRAINT FK_C0F4D834C810FC9C FOREIGN KEY (chef_etablissement_id) REFERENCES professeur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etablissement_doctoral ADD CONSTRAINT FK_C0F4D8346DC20685 FOREIGN KEY (formation_doctorale_id) REFERENCES formation_doctorale (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE formation_doctorale ADD CONSTRAINT FK_690CA78353C59D72 FOREIGN KEY (responsable_id) REFERENCES professeur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE laboratoire ADD CONSTRAINT FK_C4AD03C353C59D72 FOREIGN KEY (responsable_id) REFERENCES professeur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299A8FF483B FOREIGN KEY (ecole_rattache_formation_id) REFERENCES formation_doctorale (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE dossier DROP CONSTRAINT FK_3D48E0377E3C61F9');
        $this->addSql('ALTER TABLE etablissement_doctoral DROP CONSTRAINT FK_C0F4D8346DC20685');
        $this->addSql('ALTER TABLE professeur DROP CONSTRAINT FK_17A55299A8FF483B');
        $this->addSql('ALTER TABLE etablissement_doctoral DROP CONSTRAINT FK_C0F4D834C810FC9C');
        $this->addSql('ALTER TABLE formation_doctorale DROP CONSTRAINT FK_690CA78353C59D72');
        $this->addSql('ALTER TABLE laboratoire DROP CONSTRAINT FK_C4AD03C353C59D72');
        $this->addSql('DROP SEQUENCE document_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE dossier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE etablissement_doctoral_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE formation_doctorale_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE laboratoire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE dossier');
        $this->addSql('DROP TABLE etablissement_doctoral');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE formation_doctorale');
        $this->addSql('DROP TABLE laboratoire');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
