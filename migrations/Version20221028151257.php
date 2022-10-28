<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221028151257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE excursion ADD COLUMN excursion_data VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__excursion AS SELECT excursion_id, excursion_place_id, status_id, organisator_id, campus_id, name, start_time, duration, limite_date_registration, max_registration_number FROM excursion');
        $this->addSql('DROP TABLE excursion');
        $this->addSql('CREATE TABLE excursion (excursion_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, excursion_place_id INTEGER NOT NULL, status_id INTEGER NOT NULL, organisator_id INTEGER NOT NULL, campus_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, start_time DATETIME NOT NULL, duration INTEGER NOT NULL, limite_date_registration DATETIME NOT NULL, max_registration_number INTEGER NOT NULL, CONSTRAINT FK_9B08E72FB3752E94 FOREIGN KEY (excursion_place_id) REFERENCES place (place_id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72F6BF700BD FOREIGN KEY (status_id) REFERENCES status (status_id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72FFFDD4EC8 FOREIGN KEY (organisator_id) REFERENCES participant (participant_id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B08E72FAF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (campus_id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO excursion (excursion_id, excursion_place_id, status_id, organisator_id, campus_id, name, start_time, duration, limite_date_registration, max_registration_number) SELECT excursion_id, excursion_place_id, status_id, organisator_id, campus_id, name, start_time, duration, limite_date_registration, max_registration_number FROM __temp__excursion');
        $this->addSql('DROP TABLE __temp__excursion');
        $this->addSql('CREATE INDEX IDX_9B08E72FB3752E94 ON excursion (excursion_place_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72F6BF700BD ON excursion (status_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72FFFDD4EC8 ON excursion (organisator_id)');
        $this->addSql('CREATE INDEX IDX_9B08E72FAF5D55E1 ON excursion (campus_id)');
    }
}
