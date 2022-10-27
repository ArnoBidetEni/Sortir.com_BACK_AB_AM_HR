<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221027080226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__excursion AS SELECT excursion_id, excursion_place_id, status_id, organisator_id, campus_id, name, start_time, duration, limite_date_registration, max_registration_number FROM excursion');
        $this->addSql('DROP TABLE excursion');
        $this->addSql('CREATE TABLE excursion (excursion_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, excursion_place_id INTEGER NOT NULL, status_id INTEGER NOT NULL, organisator_id INTEGER NOT NULL, campus_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, start_time DATETIME NOT NULL, duration INTEGER NOT NULL, limite_date_registration DATETIME NOT NULL, max_registration_number INTEGER NOT NULL, CONSTRAINT FK_9B08E72FB3752E94 FOREIGN KEY (excursion_place_id) REFERENCES place (place_id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72F6BF700BD FOREIGN KEY (status_id) REFERENCES status (status_id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72FFFDD4EC8 FOREIGN KEY (organisator_id) REFERENCES participant (participant_id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72FAF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (campus_id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO excursion (excursion_id, excursion_place_id, status_id, organisator_id, campus_id, name, start_time, duration, limite_date_registration, max_registration_number) SELECT excursion_id, excursion_place_id, status_id, organisator_id, campus_id, name, start_time, duration, limite_date_registration, max_registration_number FROM __temp__excursion');
        $this->addSql('DROP TABLE __temp__excursion');
        $this->addSql('CREATE INDEX IDX_9B08E72FAF5D55E1 ON excursion (campus_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72FFFDD4EC8 ON excursion (organisator_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72F6BF700BD ON excursion (status_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72FB3752E94 ON excursion (excursion_place_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__excursions_participants AS SELECT excursion_id, participant_id FROM excursions_participants');
        $this->addSql('DROP TABLE excursions_participants');
        $this->addSql('CREATE TABLE excursions_participants (excursion_id INTEGER NOT NULL, participant_id INTEGER NOT NULL, PRIMARY KEY(excursion_id, participant_id), CONSTRAINT FK_D7D38E314AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (excursion_id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D7D38E319D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (participant_id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO excursions_participants (excursion_id, participant_id) SELECT excursion_id, participant_id FROM __temp__excursions_participants');
        $this->addSql('DROP TABLE __temp__excursions_participants');
        $this->addSql('CREATE INDEX IDX_D7D38E319D1C3019 ON excursions_participants (participant_id)');
        $this->addSql('CREATE INDEX IDX_D7D38E314AB4296F ON excursions_participants (excursion_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__participant AS SELECT participant_id, name, first_name, phone_number, mail, password, administrator, active, login, roles FROM participant');
        $this->addSql('DROP TABLE participant');
        $this->addSql('CREATE TABLE participant (participant_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, campus_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, first_name VARCHAR(100) NOT NULL, phone_number VARCHAR(10) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, administrator BOOLEAN NOT NULL, active BOOLEAN NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , CONSTRAINT FK_D79F6B11AF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (campus_id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO participant (participant_id, name, first_name, phone_number, mail, password, administrator, active, login, roles) SELECT participant_id, name, first_name, phone_number, mail, password, administrator, active, login, roles FROM __temp__participant');
        $this->addSql('DROP TABLE __temp__participant');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D79F6B11AA08CB10 ON participant (login)');
        $this->addSql('CREATE INDEX IDX_D79F6B11AF5D55E1 ON participant (campus_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__place AS SELECT place_id, city_id, name, street, latitude, longitude FROM place');
        $this->addSql('DROP TABLE place');
        $this->addSql('CREATE TABLE place (place_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cityId INTEGER NOT NULL, name VARCHAR(100) NOT NULL, street VARCHAR(100) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, CONSTRAINT FK_741D53CD7F99FC72 FOREIGN KEY (cityId) REFERENCES city (city_id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO place (place_id, cityId, name, street, latitude, longitude) SELECT place_id, city_id, name, street, latitude, longitude FROM __temp__place');
        $this->addSql('DROP TABLE __temp__place');
        $this->addSql('CREATE INDEX IDX_741D53CD7F99FC72 ON place (cityId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__excursion AS SELECT excursion_id, excursion_place_id, status_id, organisator_id, campus_id, name, start_time, duration, limite_date_registration, max_registration_number FROM excursion');
        $this->addSql('DROP TABLE excursion');
        $this->addSql('CREATE TABLE excursion (excursion_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, excursion_place_id INTEGER NOT NULL, status_id INTEGER NOT NULL, organisator_id INTEGER NOT NULL, campus_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, start_time DATETIME NOT NULL, duration INTEGER NOT NULL, limite_date_registration DATETIME NOT NULL, max_registration_number INTEGER NOT NULL, CONSTRAINT FK_9B08E72FB3752E94 FOREIGN KEY (excursion_place_id) REFERENCES place (placeId) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72F6BF700BD FOREIGN KEY (status_id) REFERENCES status (statusId) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72FFFDD4EC8 FOREIGN KEY (organisator_id) REFERENCES participant (participantId) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72FAF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (campusId) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO excursion (excursion_id, excursion_place_id, status_id, organisator_id, campus_id, name, start_time, duration, limite_date_registration, max_registration_number) SELECT excursion_id, excursion_place_id, status_id, organisator_id, campus_id, name, start_time, duration, limite_date_registration, max_registration_number FROM __temp__excursion');
        $this->addSql('DROP TABLE __temp__excursion');
        $this->addSql('CREATE INDEX IDX_9B08E72FB3752E94 ON excursion (excursion_place_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72F6BF700BD ON excursion (status_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72FFFDD4EC8 ON excursion (organisator_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72FAF5D55E1 ON excursion (campus_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__excursions_participants AS SELECT excursion_id, participant_id FROM excursions_participants');
        $this->addSql('DROP TABLE excursions_participants');
        $this->addSql('CREATE TABLE excursions_participants (excursion_id INTEGER NOT NULL, participant_id INTEGER NOT NULL, PRIMARY KEY(excursion_id, participant_id), CONSTRAINT FK_D7D38E314AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (excursionId) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D7D38E319D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (participantId) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO excursions_participants (excursion_id, participant_id) SELECT excursion_id, participant_id FROM __temp__excursions_participants');
        $this->addSql('DROP TABLE __temp__excursions_participants');
        $this->addSql('CREATE INDEX IDX_D7D38E314AB4296F ON excursions_participants (excursion_id)');
        $this->addSql('CREATE INDEX IDX_D7D38E319D1C3019 ON excursions_participants (participant_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__participant AS SELECT participant_id, name, login, roles, first_name, phone_number, mail, password, administrator, active FROM participant');
        $this->addSql('DROP TABLE participant');
        $this->addSql('CREATE TABLE participant (participant_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , first_name VARCHAR(100) NOT NULL, phone_number VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, administrator BOOLEAN NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO participant (participant_id, name, login, roles, first_name, phone_number, mail, password, administrator, active) SELECT participant_id, name, login, roles, first_name, phone_number, mail, password, administrator, active FROM __temp__participant');
        $this->addSql('DROP TABLE __temp__participant');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D79F6B11AA08CB10 ON participant (login)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__place AS SELECT place_id, name, street, latitude, longitude, cityId FROM place');
        $this->addSql('DROP TABLE place');
        $this->addSql('CREATE TABLE place (place_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, street VARCHAR(100) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, CONSTRAINT FK_741D53CD8BAC62AF FOREIGN KEY (city_id) REFERENCES city (cityId) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO place (place_id, name, street, latitude, longitude, city_id) SELECT place_id, name, street, latitude, longitude, cityId FROM __temp__place');
        $this->addSql('DROP TABLE __temp__place');
        $this->addSql('CREATE INDEX IDX_741D53CD8BAC62AF ON place (city_id)');
    }
}
