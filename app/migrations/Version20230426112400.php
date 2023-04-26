<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426112400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE feedback ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE rating_question ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE ratings ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE vico ADD deleted_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP deleted_at');
        $this->addSql('ALTER TABLE vico DROP deleted_at');
        $this->addSql('ALTER TABLE ratings DROP deleted_at');
        $this->addSql('ALTER TABLE rating_question DROP deleted_at');
        $this->addSql('ALTER TABLE project DROP deleted_at');
        $this->addSql('ALTER TABLE feedback DROP deleted_at');
    }
}
