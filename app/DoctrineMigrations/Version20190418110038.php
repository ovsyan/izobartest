<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190418110038 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE employer_id_seq1 CASCADE');
        $this->addSql('DROP SEQUENCE unit_id_seq1 CASCADE');
        $this->addSql('ALTER TABLE employer ADD position VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE employer ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE employer ALTER first_name SET NOT NULL');
        $this->addSql('ALTER TABLE employer ALTER last_name SET NOT NULL');
        $this->addSql('ALTER TABLE unit ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE employer_id_seq1 INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE unit_id_seq1 INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE unit_id_seq');
        $this->addSql('SELECT setval(\'unit_id_seq\', (SELECT MAX(id) FROM unit))');
        $this->addSql('ALTER TABLE unit ALTER id SET DEFAULT nextval(\'unit_id_seq\')');
        $this->addSql('ALTER TABLE employer DROP position');
        $this->addSql('CREATE SEQUENCE employer_id_seq');
        $this->addSql('SELECT setval(\'employer_id_seq\', (SELECT MAX(id) FROM employer))');
        $this->addSql('ALTER TABLE employer ALTER id SET DEFAULT nextval(\'employer_id_seq\')');
        $this->addSql('ALTER TABLE employer ALTER first_name DROP NOT NULL');
        $this->addSql('ALTER TABLE employer ALTER last_name DROP NOT NULL');
    }
}
