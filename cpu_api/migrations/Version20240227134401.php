<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240227134401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cpu_production ADD cpu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cpu_production ADD CONSTRAINT FK_FC3BA9213917014 FOREIGN KEY (cpu_id) REFERENCES cpu (id)');
        $this->addSql('CREATE INDEX IDX_FC3BA9213917014 ON cpu_production (cpu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cpu_production DROP FOREIGN KEY FK_FC3BA9213917014');
        $this->addSql('DROP INDEX IDX_FC3BA9213917014 ON cpu_production');
        $this->addSql('ALTER TABLE cpu_production DROP cpu_id');
    }
}
