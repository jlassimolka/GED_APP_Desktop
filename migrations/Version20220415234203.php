<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415234203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departement_user (departement_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_90B5D181CCF9E01E (departement_id), INDEX IDX_90B5D181A76ED395 (user_id), PRIMARY KEY(departement_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE departement_user ADD CONSTRAINT FK_90B5D181CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departement_user ADD CONSTRAINT FK_90B5D181A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departement CHANGE datecreation datecreation DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE document CHANGE titre titre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE processus DROP FOREIGN KEY FK_EEEA8C1D7EFB72');
        $this->addSql('DROP INDEX IDX_EEEA8C1D7EFB72 ON processus');
        $this->addSql('ALTER TABLE processus DROP userproc_id, CHANGE datecreation datecreation DATE DEFAULT NULL, CHANGE libprocessus libprocessus VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491DB279A6');
        $this->addSql('DROP INDEX IDX_8D93D6491DB279A6 ON user');
        $this->addSql('ALTER TABLE user DROP departements_id, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE departement_user');
        $this->addSql('ALTER TABLE departement CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lib_dep lib_dep VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE datecreation datecreation DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE document CHANGE reference reference VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE file file VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE titre titre VARCHAR(255) DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE processus ADD userproc_id INT DEFAULT NULL, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE datecreation datecreation DATE DEFAULT \'NULL\', CHANGE libprocessus libprocessus VARCHAR(255) DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE processus ADD CONSTRAINT FK_EEEA8C1D7EFB72 FOREIGN KEY (userproc_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EEEA8C1D7EFB72 ON processus (userproc_id)');
        $this->addSql('ALTER TABLE user ADD departements_id INT DEFAULT NULL, CHANGE fullname fullname VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491DB279A6 FOREIGN KEY (departements_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6491DB279A6 ON user (departements_id)');
    }
}
