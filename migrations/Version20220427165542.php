<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220427165542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departement CHANGE datecreation datecreation DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD createur_id INT DEFAULT NULL, CHANGE titre titre VARCHAR(255) DEFAULT NULL, CHANGE datevalidation datevalidation DATE DEFAULT NULL, CHANGE dateapprobation dateapprobation DATE DEFAULT NULL, CHANGE datearchivage datearchivage DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7673A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D8698A7673A201E5 ON document (createur_id)');
        $this->addSql('ALTER TABLE processus CHANGE datecreation datecreation DATE DEFAULT NULL, CHANGE libprocessus libprocessus VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE libcat libcat VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE departement CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lib_dep lib_dep VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE datecreation datecreation DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7673A201E5');
        $this->addSql('DROP INDEX IDX_D8698A7673A201E5 ON document');
        $this->addSql('ALTER TABLE document DROP createur_id, CHANGE reference reference VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE file file VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE titre titre VARCHAR(255) DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE datevalidation datevalidation DATE DEFAULT \'NULL\', CHANGE dateapprobation dateapprobation DATE DEFAULT \'NULL\', CHANGE datearchivage datearchivage DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE processus CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE datecreation datecreation DATE DEFAULT \'NULL\', CHANGE libprocessus libprocessus VARCHAR(255) DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE fullname fullname VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
