<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241026123213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE client ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE event ADD date_d DATE NOT NULL, ADD date_f DATE NOT NULL, ADD lieu VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD datel VARCHAR(255) NOT NULL, ADD etatl VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP nom');
        $this->addSql('ALTER TABLE client DROP nom, DROP prenom, DROP adresse');
        $this->addSql('ALTER TABLE event DROP date_d, DROP date_f, DROP lieu, DROP nom');
        $this->addSql('ALTER TABLE inscription DROP datel, DROP etatl');
    }
}
