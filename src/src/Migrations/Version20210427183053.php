<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427183053 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, composer_id INT NOT NULL, name VARCHAR(255) NOT NULL, curator VARCHAR(255) NOT NULL, organization_method VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_59A699F57A8D2620 (composer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composer (id INT AUTO_INCREMENT NOT NULL, catalogue_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, death_date DATE DEFAULT NULL, UNIQUE INDEX UNIQ_987306D84A7843DC (catalogue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composer_style (composer_id INT NOT NULL, style_id INT NOT NULL, INDEX IDX_4222D92E7A8D2620 (composer_id), INDEX IDX_4222D92EBACD6074 (style_id), PRIMARY KEY(composer_id, style_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, style_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5373C966BACD6074 (style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ensemble (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, parts_count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, ensemble_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, family VARCHAR(255) NOT NULL, INDEX IDX_3CBF69DDB268ECB1 (ensemble_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oeuvre (id INT AUTO_INCREMENT NOT NULL, composer_id INT NOT NULL, ensemble_id INT NOT NULL, name VARCHAR(255) NOT NULL, opus INT DEFAULT NULL, tonality VARCHAR(255) DEFAULT NULL, genre VARCHAR(255) DEFAULT NULL, catalogue_number INT DEFAULT NULL, INDEX IDX_35FE2EFE7A8D2620 (composer_id), INDEX IDX_35FE2EFEB268ECB1 (ensemble_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, oeuvre_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, number INT NOT NULL, tonality VARCHAR(255) DEFAULT NULL, INDEX IDX_44CA0B2388194DE8 (oeuvre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, starting_year INT NOT NULL, ending_year INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style_country (style_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_355F5752BACD6074 (style_id), INDEX IDX_355F5752F92F3E70 (country_id), PRIMARY KEY(style_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE catalogue ADD CONSTRAINT FK_59A699F57A8D2620 FOREIGN KEY (composer_id) REFERENCES composer (id)');
        $this->addSql('ALTER TABLE composer ADD CONSTRAINT FK_987306D84A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id)');
        $this->addSql('ALTER TABLE composer_style ADD CONSTRAINT FK_4222D92E7A8D2620 FOREIGN KEY (composer_id) REFERENCES composer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composer_style ADD CONSTRAINT FK_4222D92EBACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966BACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DDB268ECB1 FOREIGN KEY (ensemble_id) REFERENCES ensemble (id)');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFE7A8D2620 FOREIGN KEY (composer_id) REFERENCES composer (id)');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFEB268ECB1 FOREIGN KEY (ensemble_id) REFERENCES ensemble (id)');
        $this->addSql('ALTER TABLE piece ADD CONSTRAINT FK_44CA0B2388194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id)');
        $this->addSql('ALTER TABLE style_country ADD CONSTRAINT FK_355F5752BACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE style_country ADD CONSTRAINT FK_355F5752F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE composer DROP FOREIGN KEY FK_987306D84A7843DC');
        $this->addSql('ALTER TABLE catalogue DROP FOREIGN KEY FK_59A699F57A8D2620');
        $this->addSql('ALTER TABLE composer_style DROP FOREIGN KEY FK_4222D92E7A8D2620');
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFE7A8D2620');
        $this->addSql('ALTER TABLE style_country DROP FOREIGN KEY FK_355F5752F92F3E70');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DDB268ECB1');
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFEB268ECB1');
        $this->addSql('ALTER TABLE piece DROP FOREIGN KEY FK_44CA0B2388194DE8');
        $this->addSql('ALTER TABLE composer_style DROP FOREIGN KEY FK_4222D92EBACD6074');
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966BACD6074');
        $this->addSql('ALTER TABLE style_country DROP FOREIGN KEY FK_355F5752BACD6074');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('DROP TABLE composer');
        $this->addSql('DROP TABLE composer_style');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE ensemble');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE oeuvre');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE style_country');
    }
}
