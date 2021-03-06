<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127162435 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE infos (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE adresses');
        $this->addSql('DROP TABLE bannieres');
        $this->addSql('DROP TABLE presentation');
        $this->addSql('ALTER TABLE contact CHANGE society society VARCHAR(255) DEFAULT NULL, CHANGE contact_object contactobject VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE intro CHANGE slug slug VARCHAR(255) DEFAULT NULL, CHANGE cover_image cover_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE news CHANGE slug slug VARCHAR(255) DEFAULT NULL, CHANGE title title VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE partner CHANGE slug slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE prestations CHANGE slug slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE team CHANGE bio bio VARCHAR(255) DEFAULT NULL, CHANGE slug slug VARCHAR(255) DEFAULT NULL, CHANGE title title VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE password hash VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adresses (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, rue VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, code_postal VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ville VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, tel VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, mail VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, slug VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE bannieres (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE presentation (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, img VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE infos');
        $this->addSql('ALTER TABLE contact CHANGE society society VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE contactobject contact_object VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE intro CHANGE slug slug VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE cover_image cover_image VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE news CHANGE slug slug VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE title title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE partner CHANGE slug slug VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE prestations CHANGE slug slug VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE team CHANGE title title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE bio bio VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE slug slug VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE hash password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
