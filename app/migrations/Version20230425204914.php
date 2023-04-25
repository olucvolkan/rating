<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425204914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, project INT DEFAULT NULL, client INT DEFAULT NULL, comment VARCHAR(255) NOT NULL, overall_rating DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D22944582FB3D0EE (project), INDEX IDX_D2294458C7440455 (client), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating_question (id INT AUTO_INCREMENT NOT NULL, project INT DEFAULT NULL, question_text VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_E8CAFCB92FB3D0EE (project), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ratings (id INT AUTO_INCREMENT NOT NULL, feedback INT DEFAULT NULL, rating_question INT DEFAULT NULL, score DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_CEB607C9D2294458 (feedback), INDEX IDX_CEB607C9E8CAFCB9 (rating_question), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D22944582FB3D0EE FOREIGN KEY (project) REFERENCES project (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458C7440455 FOREIGN KEY (client) REFERENCES client (id)');
        $this->addSql('ALTER TABLE rating_question ADD CONSTRAINT FK_E8CAFCB92FB3D0EE FOREIGN KEY (project) REFERENCES project (id)');
        $this->addSql('ALTER TABLE ratings ADD CONSTRAINT FK_CEB607C9D2294458 FOREIGN KEY (feedback) REFERENCES feedback (id)');
        $this->addSql('ALTER TABLE ratings ADD CONSTRAINT FK_CEB607C9E8CAFCB9 FOREIGN KEY (rating_question) REFERENCES rating_question (id)');
        $this->addSql('DROP INDEX username_idx ON client');
        $this->addSql('ALTER TABLE project CHANGE creator_id creator_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D22944582FB3D0EE');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458C7440455');
        $this->addSql('ALTER TABLE rating_question DROP FOREIGN KEY FK_E8CAFCB92FB3D0EE');
        $this->addSql('ALTER TABLE ratings DROP FOREIGN KEY FK_CEB607C9D2294458');
        $this->addSql('ALTER TABLE ratings DROP FOREIGN KEY FK_CEB607C9E8CAFCB9');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE rating_question');
        $this->addSql('DROP TABLE ratings');
        $this->addSql('CREATE INDEX username_idx ON client (username)');
        $this->addSql('ALTER TABLE project CHANGE creator_id creator_id INT NOT NULL');
    }
}
