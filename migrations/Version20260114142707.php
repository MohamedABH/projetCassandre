<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260114142707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audit (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, INDEX IDX_9218FF79979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_task (id INT AUTO_INCREMENT NOT NULL, name_task VARCHAR(255) NOT NULL, description_task VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE observation (id INT AUTO_INCREMENT NOT NULL, audit_id INT NOT NULL, task_id INT NOT NULL, description_observation VARCHAR(255) DEFAULT NULL, INDEX IDX_C576DBE0BD29F359 (audit_id), INDEX IDX_C576DBE08DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE observation ADD CONSTRAINT FK_C576DBE0BD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id)');
        $this->addSql('ALTER TABLE observation ADD CONSTRAINT FK_C576DBE08DB60186 FOREIGN KEY (task_id) REFERENCES audit_task (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79979B1AD6');
        $this->addSql('ALTER TABLE observation DROP FOREIGN KEY FK_C576DBE0BD29F359');
        $this->addSql('ALTER TABLE observation DROP FOREIGN KEY FK_C576DBE08DB60186');
        $this->addSql('DROP TABLE audit');
        $this->addSql('DROP TABLE audit_task');
        $this->addSql('DROP TABLE observation');
    }
}
