<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220314172900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document ADD dossier_id INT NOT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
        $this->addSql('CREATE INDEX IDX_D8698A76611C0C56 ON document (dossier_id)');
        $this->addSql('ALTER TABLE dossier ADD directeur_these_id INT NOT NULL');
        $this->addSql('ALTER TABLE dossier ADD CONSTRAINT FK_3D48E037B9866E9C FOREIGN KEY (directeur_these_id) REFERENCES professeur (id)');
        $this->addSql('CREATE INDEX IDX_3D48E037B9866E9C ON dossier (directeur_these_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76611C0C56');
        $this->addSql('DROP INDEX IDX_D8698A76611C0C56 ON document');
        $this->addSql('ALTER TABLE document DROP dossier_id');
        $this->addSql('ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E037B9866E9C');
        $this->addSql('DROP INDEX IDX_3D48E037B9866E9C ON dossier');
        $this->addSql('ALTER TABLE dossier DROP directeur_these_id');
    }
}
