<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426151736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback CHANGE overall_rating overall_rating DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE ratings CHANGE deleted_at deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:deleted_at)\'');
        $this->addSql('CREATE INDEX IDX_CEB607C94AF38FD1 ON ratings (deleted_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_CEB607C94AF38FD1 ON ratings');
        $this->addSql('ALTER TABLE ratings CHANGE deleted_at deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE feedback CHANGE overall_rating overall_rating DOUBLE PRECISION NOT NULL');
    }
}
