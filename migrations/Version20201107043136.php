<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201107043136 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE confection (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE contrat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, bordereau VARCHAR(255) NOT NULL, signed_at DATETIME NOT NULL, ended_at DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE INDEX IDX_6034999319EB6921 ON contrat (client_id)');
        $this->addSql('CREATE TABLE image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, panneau_id INTEGER DEFAULT NULL, filename VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_C53D045F79B971A0 ON image (panneau_id)');
        $this->addSql('CREATE TABLE offre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, duration INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE panneau (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, confection_id INTEGER NOT NULL, typologie_id INTEGER NOT NULL, contrat_id INTEGER NOT NULL, format VARCHAR(100) NOT NULL, unit VARCHAR(20) NOT NULL, lat VARCHAR(50) NOT NULL, lng VARCHAR(50) NOT NULL, tarif_impression DOUBLE PRECISION NOT NULL, rating DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE INDEX IDX_5DC24C281E077FF5 ON panneau (confection_id)');
        $this->addSql('CREATE INDEX IDX_5DC24C2842F4634A ON panneau (typologie_id)');
        $this->addSql('CREATE INDEX IDX_5DC24C281823061F ON panneau (contrat_id)');
        $this->addSql('CREATE TABLE panneau_offre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, offre_id INTEGER NOT NULL, panneau_id INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE INDEX IDX_EB62C38E4CC8505A ON panneau_offre (offre_id)');
        $this->addSql('CREATE INDEX IDX_EB62C38E79B971A0 ON panneau_offre (panneau_id)');
        $this->addSql('CREATE TABLE payement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contrat_id INTEGER NOT NULL, reference VARCHAR(255) NOT NULL, somme DOUBLE PRECISION NOT NULL, mode_payement VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_B20A78851823061F ON payement (contrat_id)');
        $this->addSql('CREATE TABLE typologie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE confection');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE panneau');
        $this->addSql('DROP TABLE panneau_offre');
        $this->addSql('DROP TABLE payement');
        $this->addSql('DROP TABLE typologie');
    }
}
