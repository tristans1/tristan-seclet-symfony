<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230205212243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE people (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, gender VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE people_species (people_id INT NOT NULL, species_id INT NOT NULL, INDEX IDX_E5A6EB563147C936 (people_id), INDEX IDX_E5A6EB56B2A1D860 (species_id), PRIMARY KEY(people_id, species_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE people_vehicle (people_id INT NOT NULL, vehicle_id INT NOT NULL, INDEX IDX_5B29F8C23147C936 (people_id), INDEX IDX_5B29F8C2545317D1 (vehicle_id), PRIMARY KEY(people_id, vehicle_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE people_starship (people_id INT NOT NULL, starship_id INT NOT NULL, INDEX IDX_B5E5CADF3147C936 (people_id), INDEX IDX_B5E5CADF9B24DF5 (starship_id), PRIMARY KEY(people_id, starship_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, population INT DEFAULT NULL, diameter INT DEFAULT NULL, gravity INT DEFAULT NULL, climate VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE species (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, language VARCHAR(255) DEFAULT NULL, skin_color VARCHAR(255) DEFAULT NULL, lifespan VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE starship (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, capacity INT DEFAULT NULL, hyperdrive_rating VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, model VARCHAR(255) DEFAULT NULL, capacity INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE people_species ADD CONSTRAINT FK_E5A6EB563147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE people_species ADD CONSTRAINT FK_E5A6EB56B2A1D860 FOREIGN KEY (species_id) REFERENCES species (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE people_vehicle ADD CONSTRAINT FK_5B29F8C23147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE people_vehicle ADD CONSTRAINT FK_5B29F8C2545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE people_starship ADD CONSTRAINT FK_B5E5CADF3147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE people_starship ADD CONSTRAINT FK_B5E5CADF9B24DF5 FOREIGN KEY (starship_id) REFERENCES starship (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE people_species DROP FOREIGN KEY FK_E5A6EB563147C936');
        $this->addSql('ALTER TABLE people_species DROP FOREIGN KEY FK_E5A6EB56B2A1D860');
        $this->addSql('ALTER TABLE people_vehicle DROP FOREIGN KEY FK_5B29F8C23147C936');
        $this->addSql('ALTER TABLE people_vehicle DROP FOREIGN KEY FK_5B29F8C2545317D1');
        $this->addSql('ALTER TABLE people_starship DROP FOREIGN KEY FK_B5E5CADF3147C936');
        $this->addSql('ALTER TABLE people_starship DROP FOREIGN KEY FK_B5E5CADF9B24DF5');
        $this->addSql('DROP TABLE people');
        $this->addSql('DROP TABLE people_species');
        $this->addSql('DROP TABLE people_vehicle');
        $this->addSql('DROP TABLE people_starship');
        $this->addSql('DROP TABLE planet');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE starship');
        $this->addSql('DROP TABLE vehicle');
    }
}
