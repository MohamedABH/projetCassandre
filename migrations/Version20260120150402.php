<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260120150402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certification ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE certification ADD CONSTRAINT FK_6C3C6D7519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_6C3C6D7519EB6921 ON certification (client_id)');
        $this->addSql('ALTER TABLE collaborator CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE collaborator ADD CONSTRAINT FK_606D487CBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collaborator DROP FOREIGN KEY FK_606D487CBF396750');
        $this->addSql('ALTER TABLE collaborator CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE certification DROP FOREIGN KEY FK_6C3C6D7519EB6921');
        $this->addSql('DROP INDEX IDX_6C3C6D7519EB6921 ON certification');
        $this->addSql('ALTER TABLE certification DROP client_id');
    }
}
