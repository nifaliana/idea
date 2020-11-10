<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201109130823 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_6034999319EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contrat AS SELECT id, client_id, bordereau, signed_at, ended_at, amount FROM contrat');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('CREATE TABLE contrat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, bordereau VARCHAR(255) NOT NULL COLLATE BINARY, signed_at DATETIME NOT NULL, ended_at DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, updated_at DATETIME DEFAULT NULL, CONSTRAINT FK_6034999319EB6921 FOREIGN KEY (client_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO contrat (id, client_id, bordereau, signed_at, ended_at, amount) SELECT id, client_id, bordereau, signed_at, ended_at, amount FROM __temp__contrat');
        $this->addSql('DROP TABLE __temp__contrat');
        $this->addSql('CREATE INDEX IDX_6034999319EB6921 ON contrat (client_id)');
        $this->addSql('DROP INDEX IDX_C53D045F79B971A0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__image AS SELECT id, panneau_id, filename FROM image');
        $this->addSql('DROP TABLE image');
        $this->addSql('CREATE TABLE image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, panneau_id INTEGER DEFAULT NULL, filename VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_C53D045F79B971A0 FOREIGN KEY (panneau_id) REFERENCES panneau (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO image (id, panneau_id, filename) SELECT id, panneau_id, filename FROM __temp__image');
        $this->addSql('DROP TABLE __temp__image');
        $this->addSql('CREATE INDEX IDX_C53D045F79B971A0 ON image (panneau_id)');
        $this->addSql('DROP INDEX IDX_5DC24C281823061F');
        $this->addSql('DROP INDEX IDX_5DC24C2842F4634A');
        $this->addSql('DROP INDEX IDX_5DC24C281E077FF5');
        $this->addSql('CREATE TEMPORARY TABLE __temp__panneau AS SELECT id, confection_id, typologie_id, contrat_id, format, unit, lat, lng, tarif_impression, rating FROM panneau');
        $this->addSql('DROP TABLE panneau');
        $this->addSql('CREATE TABLE panneau (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, confection_id INTEGER NOT NULL, typologie_id INTEGER NOT NULL, contrat_id INTEGER NOT NULL, format VARCHAR(100) NOT NULL COLLATE BINARY, unit VARCHAR(20) NOT NULL COLLATE BINARY, lat VARCHAR(50) NOT NULL COLLATE BINARY, lng VARCHAR(50) NOT NULL COLLATE BINARY, tarif_impression DOUBLE PRECISION NOT NULL, rating DOUBLE PRECISION NOT NULL, CONSTRAINT FK_5DC24C281E077FF5 FOREIGN KEY (confection_id) REFERENCES confection (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5DC24C2842F4634A FOREIGN KEY (typologie_id) REFERENCES typologie (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5DC24C281823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO panneau (id, confection_id, typologie_id, contrat_id, format, unit, lat, lng, tarif_impression, rating) SELECT id, confection_id, typologie_id, contrat_id, format, unit, lat, lng, tarif_impression, rating FROM __temp__panneau');
        $this->addSql('DROP TABLE __temp__panneau');
        $this->addSql('CREATE INDEX IDX_5DC24C281823061F ON panneau (contrat_id)');
        $this->addSql('CREATE INDEX IDX_5DC24C2842F4634A ON panneau (typologie_id)');
        $this->addSql('CREATE INDEX IDX_5DC24C281E077FF5 ON panneau (confection_id)');
        $this->addSql('DROP INDEX IDX_EB62C38E79B971A0');
        $this->addSql('DROP INDEX IDX_EB62C38E4CC8505A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__panneau_offre AS SELECT id, offre_id, panneau_id, price FROM panneau_offre');
        $this->addSql('DROP TABLE panneau_offre');
        $this->addSql('CREATE TABLE panneau_offre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, offre_id INTEGER NOT NULL, panneau_id INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL, CONSTRAINT FK_EB62C38E4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_EB62C38E79B971A0 FOREIGN KEY (panneau_id) REFERENCES panneau (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO panneau_offre (id, offre_id, panneau_id, price) SELECT id, offre_id, panneau_id, price FROM __temp__panneau_offre');
        $this->addSql('DROP TABLE __temp__panneau_offre');
        $this->addSql('CREATE INDEX IDX_EB62C38E79B971A0 ON panneau_offre (panneau_id)');
        $this->addSql('CREATE INDEX IDX_EB62C38E4CC8505A ON panneau_offre (offre_id)');
        $this->addSql('DROP INDEX IDX_B20A78851823061F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__payement AS SELECT id, contrat_id, reference, somme, mode_payement FROM payement');
        $this->addSql('DROP TABLE payement');
        $this->addSql('CREATE TABLE payement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contrat_id INTEGER NOT NULL, reference VARCHAR(255) NOT NULL COLLATE BINARY, somme DOUBLE PRECISION NOT NULL, mode_payement VARCHAR(50) NOT NULL COLLATE BINARY, CONSTRAINT FK_B20A78851823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO payement (id, contrat_id, reference, somme, mode_payement) SELECT id, contrat_id, reference, somme, mode_payement FROM __temp__payement');
        $this->addSql('DROP TABLE __temp__payement');
        $this->addSql('CREATE INDEX IDX_B20A78851823061F ON payement (contrat_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_6034999319EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contrat AS SELECT id, client_id, bordereau, signed_at, ended_at, amount FROM contrat');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('CREATE TABLE contrat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, bordereau VARCHAR(255) NOT NULL, signed_at DATETIME NOT NULL, ended_at DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO contrat (id, client_id, bordereau, signed_at, ended_at, amount) SELECT id, client_id, bordereau, signed_at, ended_at, amount FROM __temp__contrat');
        $this->addSql('DROP TABLE __temp__contrat');
        $this->addSql('CREATE INDEX IDX_6034999319EB6921 ON contrat (client_id)');
        $this->addSql('DROP INDEX IDX_C53D045F79B971A0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__image AS SELECT id, panneau_id, filename FROM image');
        $this->addSql('DROP TABLE image');
        $this->addSql('CREATE TABLE image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, panneau_id INTEGER DEFAULT NULL, filename VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO image (id, panneau_id, filename) SELECT id, panneau_id, filename FROM __temp__image');
        $this->addSql('DROP TABLE __temp__image');
        $this->addSql('CREATE INDEX IDX_C53D045F79B971A0 ON image (panneau_id)');
        $this->addSql('DROP INDEX IDX_5DC24C281E077FF5');
        $this->addSql('DROP INDEX IDX_5DC24C2842F4634A');
        $this->addSql('DROP INDEX IDX_5DC24C281823061F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__panneau AS SELECT id, confection_id, typologie_id, contrat_id, format, unit, lat, lng, tarif_impression, rating FROM panneau');
        $this->addSql('DROP TABLE panneau');
        $this->addSql('CREATE TABLE panneau (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, confection_id INTEGER NOT NULL, typologie_id INTEGER NOT NULL, contrat_id INTEGER NOT NULL, format VARCHAR(100) NOT NULL, unit VARCHAR(20) NOT NULL, lat VARCHAR(50) NOT NULL, lng VARCHAR(50) NOT NULL, tarif_impression DOUBLE PRECISION NOT NULL, rating DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO panneau (id, confection_id, typologie_id, contrat_id, format, unit, lat, lng, tarif_impression, rating) SELECT id, confection_id, typologie_id, contrat_id, format, unit, lat, lng, tarif_impression, rating FROM __temp__panneau');
        $this->addSql('DROP TABLE __temp__panneau');
        $this->addSql('CREATE INDEX IDX_5DC24C281E077FF5 ON panneau (confection_id)');
        $this->addSql('CREATE INDEX IDX_5DC24C2842F4634A ON panneau (typologie_id)');
        $this->addSql('CREATE INDEX IDX_5DC24C281823061F ON panneau (contrat_id)');
        $this->addSql('DROP INDEX IDX_EB62C38E4CC8505A');
        $this->addSql('DROP INDEX IDX_EB62C38E79B971A0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__panneau_offre AS SELECT id, offre_id, panneau_id, price FROM panneau_offre');
        $this->addSql('DROP TABLE panneau_offre');
        $this->addSql('CREATE TABLE panneau_offre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, offre_id INTEGER NOT NULL, panneau_id INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO panneau_offre (id, offre_id, panneau_id, price) SELECT id, offre_id, panneau_id, price FROM __temp__panneau_offre');
        $this->addSql('DROP TABLE __temp__panneau_offre');
        $this->addSql('CREATE INDEX IDX_EB62C38E4CC8505A ON panneau_offre (offre_id)');
        $this->addSql('CREATE INDEX IDX_EB62C38E79B971A0 ON panneau_offre (panneau_id)');
        $this->addSql('DROP INDEX IDX_B20A78851823061F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__payement AS SELECT id, contrat_id, reference, somme, mode_payement FROM payement');
        $this->addSql('DROP TABLE payement');
        $this->addSql('CREATE TABLE payement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contrat_id INTEGER NOT NULL, reference VARCHAR(255) NOT NULL, somme DOUBLE PRECISION NOT NULL, mode_payement VARCHAR(50) NOT NULL)');
        $this->addSql('INSERT INTO payement (id, contrat_id, reference, somme, mode_payement) SELECT id, contrat_id, reference, somme, mode_payement FROM __temp__payement');
        $this->addSql('DROP TABLE __temp__payement');
        $this->addSql('CREATE INDEX IDX_B20A78851823061F ON payement (contrat_id)');
    }
}
