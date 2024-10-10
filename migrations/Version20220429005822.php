<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429005822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634AA6957DC');
        $this->addSql('DROP INDEX IDX_497DD634AA6957DC ON categorie');
        $this->addSql('ALTER TABLE categorie DROP docategorie_id');
        $this->addSql('ALTER TABLE document ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_D8698A76BCF5E72D ON document (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD docategorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634AA6957DC FOREIGN KEY (docategorie_id) REFERENCES document (id)');
        $this->addSql('CREATE INDEX IDX_497DD634AA6957DC ON categorie (docategorie_id)');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76BCF5E72D');
        $this->addSql('DROP INDEX IDX_D8698A76BCF5E72D ON document');
        $this->addSql('ALTER TABLE document DROP categorie_id');
    }
}
