<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221025080759 extends AbstractMigration
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
        $this->addSql('CREATE TABLE excursion (excursion_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, excursion_place_id INTEGER NOT NULL, status_id INTEGER NOT NULL, organisator_id INTEGER NOT NULL, campus_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, start_time DATETIME NOT NULL, duration INTEGER NOT NULL, limite_date_registration DATETIME NOT NULL, max_registration_number INTEGER NOT NULL, CONSTRAINT FK_9B08E72FB3752E94 FOREIGN KEY (excursion_place_id) REFERENCES place (placeId) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72F6BF700BD FOREIGN KEY (status_id) REFERENCES status (statusId) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72FFFDD4EC8 FOREIGN KEY (organisator_id) REFERENCES participant (participantId) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72FAF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (campusId) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_9B08E72FB3752E94 ON excursion (excursion_place_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72F6BF700BD ON excursion (status_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72FFFDD4EC8 ON excursion (organisator_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72FAF5D55E1 ON excursion (campus_id)');
        $this->addSql('CREATE TABLE excursions_participants (excursion_id INTEGER NOT NULL, participant_id INTEGER NOT NULL, PRIMARY KEY(excursion_id, participant_id), CONSTRAINT FK_D7D38E314AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (excursionId) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D7D38E319D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (participantId) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D7D38E314AB4296F ON excursions_participants (excursion_id)');
        $this->addSql('CREATE INDEX IDX_D7D38E319D1C3019 ON excursions_participants (participant_id)');
        $this->addSql('CREATE TABLE participant (participant_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL, first_name VARCHAR(100) NOT NULL, phone_number VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, administrator BOOLEAN NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE place (place_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, street VARCHAR(100) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, CONSTRAINT FK_741D53CD8BAC62AF FOREIGN KEY (city_id) REFERENCES city (cityId) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_741D53CD8BAC62AF ON place (city_id)');
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
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
