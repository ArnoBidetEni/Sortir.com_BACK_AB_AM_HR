<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221031124409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campus (campus_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE TABLE city (city_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL, post_code VARCHAR(5) NOT NULL)');
        $this->addSql('CREATE TABLE excursion (excursion_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, excursion_place_id INTEGER NOT NULL, status_id INTEGER NOT NULL, organisator_id INTEGER NOT NULL, campus_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, start_time DATETIME NOT NULL, duration INTEGER NOT NULL, limit_date_registration DATETIME NOT NULL, max_registration_number INTEGER NOT NULL, excursion_data VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_9B08E72FB3752E94 FOREIGN KEY (excursion_place_id) REFERENCES place (place_id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72F6BF700BD FOREIGN KEY (status_id) REFERENCES status (status_id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72FFFDD4EC8 FOREIGN KEY (organisator_id) REFERENCES participant (participant_id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72FAF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (campus_id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_9B08E72FB3752E94 ON excursion (excursion_place_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72F6BF700BD ON excursion (status_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72FFFDD4EC8 ON excursion (organisator_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72FAF5D55E1 ON excursion (campus_id)');
        $this->addSql('CREATE TABLE excursions_participants (excursion_id INTEGER NOT NULL, participant_id INTEGER NOT NULL, PRIMARY KEY(excursion_id, participant_id), CONSTRAINT FK_D7D38E314AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (excursion_id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D7D38E319D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (participant_id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D7D38E314AB4296F ON excursions_participants (excursion_id)');
        $this->addSql('CREATE INDEX IDX_D7D38E319D1C3019 ON excursions_participants (participant_id)');
        $this->addSql('CREATE TABLE participant (participant_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, campus_id INTEGER NOT NULL, last_name VARCHAR(100) NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , first_name VARCHAR(100) NOT NULL, phone_number VARCHAR(10) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, administrator BOOLEAN NOT NULL, active BOOLEAN NOT NULL, CONSTRAINT FK_D79F6B11AF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (campus_id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D79F6B11AA08CB10 ON participant (login)');
        $this->addSql('CREATE INDEX IDX_D79F6B11AF5D55E1 ON participant (campus_id)');
        $this->addSql('CREATE TABLE place (place_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL, street VARCHAR(100) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, cityId INTEGER NOT NULL, CONSTRAINT FK_741D53CD7F99FC72 FOREIGN KEY (cityId) REFERENCES city (city_id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_741D53CD7F99FC72 ON place (cityId)');
        $this->addSql('CREATE TABLE refresh_token (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74F2195C74F2195 ON refresh_token (refresh_token)');
        $this->addSql('CREATE TABLE status (status_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE campus');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE excursion');
        $this->addSql('DROP TABLE excursions_participants');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE refresh_token');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
