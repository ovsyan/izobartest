<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190423092351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE comment_id_seq1 CASCADE');
        $this->addSql('DROP INDEX uniq_de4cf066a0d96fbf');
        $this->addSql('DROP INDEX uniq_de4cf06692fc23a8');
        $this->addSql('DROP INDEX uniq_de4cf066c05fb297');
        $this->addSql('ALTER TABLE employer DROP username');
        $this->addSql('ALTER TABLE employer DROP username_canonical');
        $this->addSql('ALTER TABLE employer DROP email_canonical');
        $this->addSql('ALTER TABLE employer DROP enabled');
        $this->addSql('ALTER TABLE employer DROP salt');
        $this->addSql('ALTER TABLE employer DROP password');
        $this->addSql('ALTER TABLE employer DROP last_login');
        $this->addSql('ALTER TABLE employer DROP confirmation_token');
        $this->addSql('ALTER TABLE employer DROP password_requested_at');
        $this->addSql('ALTER TABLE employer DROP roles');
        $this->addSql('ALTER TABLE employer ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE comment ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE comment_id_seq1 INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq');
        $this->addSql('SELECT setval(\'comment_id_seq\', (SELECT MAX(id) FROM comment))');
        $this->addSql('ALTER TABLE comment ALTER id SET DEFAULT nextval(\'comment_id_seq\')');
        $this->addSql('ALTER TABLE employer ADD username VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE employer ADD username_canonical VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE employer ADD email_canonical VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE employer ADD enabled BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE employer ADD salt VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE employer ADD password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE employer ADD last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE employer ADD confirmation_token VARCHAR(180) DEFAULT NULL');
        $this->addSql('ALTER TABLE employer ADD password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE employer ADD roles TEXT NOT NULL');
        $this->addSql('ALTER TABLE employer ALTER email TYPE VARCHAR(180)');
        $this->addSql('COMMENT ON COLUMN employer.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE UNIQUE INDEX uniq_de4cf066a0d96fbf ON employer (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX uniq_de4cf06692fc23a8 ON employer (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX uniq_de4cf066c05fb297 ON employer (confirmation_token)');
    }
}
