<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210430150250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE instrument');
        $this->addSql('ALTER TABLE composer CHANGE birth_date birth_date DATE DEFAULT NULL, CHANGE death_date death_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE country CHANGE style_id style_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE oeuvre CHANGE opus opus INT DEFAULT NULL, CHANGE tonality tonality VARCHAR(255) DEFAULT NULL, CHANGE genre genre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE piece CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE tonality tonality VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE style CHANGE ending_year ending_year INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, ensemble_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, family VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_3CBF69DDB268ECB1 (ensemble_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DDB268ECB1 FOREIGN KEY (ensemble_id) REFERENCES ensemble (id)');
        $this->addSql('ALTER TABLE composer CHANGE birth_date birth_date DATE DEFAULT \'NULL\', CHANGE death_date death_date DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE country CHANGE style_id style_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE oeuvre CHANGE opus opus INT DEFAULT NULL, CHANGE tonality tonality VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE genre genre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE piece CHANGE title title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tonality tonality VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE style CHANGE ending_year ending_year INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
