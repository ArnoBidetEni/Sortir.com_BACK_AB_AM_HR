<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221103082543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant ADD COLUMN picture VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__participant AS SELECT participant_id, campus_id, last_name, login, roles, first_name, phone_number, mail, password, administrator, active FROM participant');
        $this->addSql('DROP TABLE participant');
        $this->addSql('CREATE TABLE participant (participant_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, campus_id INTEGER NOT NULL, last_name VARCHAR(100) NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , first_name VARCHAR(100) NOT NULL, phone_number VARCHAR(10) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, administrator BOOLEAN NOT NULL, active BOOLEAN NOT NULL, CONSTRAINT FK_D79F6B11AF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (campus_id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO participant (participant_id, campus_id, last_name, login, roles, first_name, phone_number, mail, password, administrator, active) SELECT participant_id, campus_id, last_name, login, roles, first_name, phone_number, mail, password, administrator, active FROM __temp__participant');
        $this->addSql('DROP TABLE __temp__participant');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D79F6B11AA08CB10 ON participant (login)');
        $this->addSql('CREATE INDEX IDX_D79F6B11AF5D55E1 ON participant (campus_id)');
    }
}
