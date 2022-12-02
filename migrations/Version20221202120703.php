<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202120703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events ADD fk_organizer_id INT NOT NULL');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AA6B14FC3 FOREIGN KEY (fk_organizer_id) REFERENCES organisers (id)');
        $this->addSql('CREATE INDEX IDX_5387574AA6B14FC3 ON events (fk_organizer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574AA6B14FC3');
        $this->addSql('DROP INDEX IDX_5387574AA6B14FC3 ON events');
        $this->addSql('ALTER TABLE events DROP fk_organizer_id');
    }
}
