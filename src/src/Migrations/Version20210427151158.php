<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427151158 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, curator VARCHAR(255) NOT NULL, organization_method VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composer_style (composer_id INT NOT NULL, style_id INT NOT NULL, INDEX IDX_4222D92E7A8D2620 (composer_id), INDEX IDX_4222D92EBACD6074 (style_id), PRIMARY KEY(composer_id, style_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, style_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5373C966BACD6074 (style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ensemble (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, parts_count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, oeuvre_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, number INT NOT NULL, tonality VARCHAR(255) DEFAULT NULL, INDEX IDX_44CA0B2388194DE8 (oeuvre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style_country (style_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_355F5752BACD6074 (style_id), INDEX IDX_355F5752F92F3E70 (country_id), PRIMARY KEY(style_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composer_style ADD CONSTRAINT FK_4222D92E7A8D2620 FOREIGN KEY (composer_id) REFERENCES composer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composer_style ADD CONSTRAINT FK_4222D92EBACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966BACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
        $this->addSql('ALTER TABLE piece ADD CONSTRAINT FK_44CA0B2388194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id)');
        $this->addSql('ALTER TABLE style_country ADD CONSTRAINT FK_355F5752BACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE style_country ADD CONSTRAINT FK_355F5752F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composer ADD catalogue_id INT DEFAULT NULL, DROP nationality, DROP main_style, CHANGE birth_date birth_date DATE DEFAULT NULL, CHANGE death_date death_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE composer ADD CONSTRAINT FK_987306D84A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_987306D84A7843DC ON composer (catalogue_id)');
        $this->addSql('ALTER TABLE instrument ADD ensemble_id INT DEFAULT NULL, DROP extension');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DDB268ECB1 FOREIGN KEY (ensemble_id) REFERENCES ensemble (id)');
        $this->addSql('CREATE INDEX IDX_3CBF69DDB268ECB1 ON instrument (ensemble_id)');
        $this->addSql('ALTER TABLE oeuvre ADD ensemble_id INT NOT NULL, ADD catalogue_number INT DEFAULT NULL, DROP number, DROP catalog_name, DROP catalog_number, CHANGE opus opus INT DEFAULT NULL, CHANGE tonality tonality VARCHAR(255) DEFAULT NULL, CHANGE genre genre VARCHAR(255) DEFAULT NULL, CHANGE composer composer_id INT NOT NULL');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFE7A8D2620 FOREIGN KEY (composer_id) REFERENCES composer (id)');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFEB268ECB1 FOREIGN KEY (ensemble_id) REFERENCES ensemble (id)');
        $this->addSql('CREATE INDEX IDX_35FE2EFE7A8D2620 ON oeuvre (composer_id)');
        $this->addSql('CREATE INDEX IDX_35FE2EFEB268ECB1 ON oeuvre (ensemble_id)');
        $this->addSql('ALTER TABLE style DROP main_region, CHANGE ending_year ending_year INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE composer DROP FOREIGN KEY FK_987306D84A7843DC');
        $this->addSql('ALTER TABLE style_country DROP FOREIGN KEY FK_355F5752F92F3E70');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DDB268ECB1');
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFEB268ECB1');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('DROP TABLE composer_style');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE ensemble');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE style_country');
        $this->addSql('DROP INDEX UNIQ_987306D84A7843DC ON composer');
        $this->addSql('ALTER TABLE composer ADD nationality VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD main_style INT DEFAULT NULL, DROP catalogue_id, CHANGE birth_date birth_date DATE DEFAULT \'NULL\', CHANGE death_date death_date DATE DEFAULT \'NULL\'');
        $this->addSql('DROP INDEX IDX_3CBF69DDB268ECB1 ON instrument');
        $this->addSql('ALTER TABLE instrument ADD extension VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP ensemble_id');
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFE7A8D2620');
        $this->addSql('DROP INDEX IDX_35FE2EFE7A8D2620 ON oeuvre');
        $this->addSql('DROP INDEX IDX_35FE2EFEB268ECB1 ON oeuvre');
        $this->addSql('ALTER TABLE oeuvre ADD number INT DEFAULT NULL, ADD catalog_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD catalog_number INT DEFAULT NULL, ADD composer INT NOT NULL, DROP composer_id, DROP ensemble_id, DROP catalogue_number, CHANGE opus opus INT DEFAULT NULL, CHANGE tonality tonality VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE genre genre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE style ADD main_region VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ending_year ending_year INT DEFAULT NULL');
    }
}
