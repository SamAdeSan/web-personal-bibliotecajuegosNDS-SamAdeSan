<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251113091556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juego_nds ADD CONSTRAINT FK_5534BA76A5EDAE9 FOREIGN KEY (biblioteca_id) REFERENCES biblioteca (id)');
        $this->addSql('CREATE INDEX IDX_5534BA76A5EDAE9 ON juego_nds (biblioteca_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juego_nds DROP FOREIGN KEY FK_5534BA76A5EDAE9');
        $this->addSql('DROP INDEX IDX_5534BA76A5EDAE9 ON juego_nds');
    }
}
