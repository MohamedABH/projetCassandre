<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260120145911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audit_type (id INT AUTO_INCREMENT NOT NULL, audit_type_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_type_audit_task (audit_type_id INT NOT NULL, audit_task_id INT NOT NULL, INDEX IDX_2B924479D46E59E3 (audit_type_id), INDEX IDX_2B9244799C94D4F6 (audit_task_id), PRIMARY KEY(audit_type_id, audit_task_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bill (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, super_category_id INT DEFAULT NULL, category_name VARCHAR(255) NOT NULL, INDEX IDX_64C19C1B85A1111 (super_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certification (id INT AUTO_INCREMENT NOT NULL, certification_type_id INT NOT NULL, bill_id INT NOT NULL, certification_status VARCHAR(255) NOT NULL, INDEX IDX_6C3C6D7590AF82A5 (certification_type_id), UNIQUE INDEX UNIQ_6C3C6D751A8C12F5 (bill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certification_type (id INT AUTO_INCREMENT NOT NULL, certification_type_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collaborator (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, role_id INT DEFAULT NULL, document_path VARCHAR(255) NOT NULL, INDEX IDX_D8698A7612469DE2 (category_id), INDEX IDX_D8698A76D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_tag (document_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_D0234567C33F7837 (document_id), INDEX IDX_D0234567BAD26311 (tag_id), PRIMARY KEY(document_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, tag_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE audit_type_audit_task ADD CONSTRAINT FK_2B924479D46E59E3 FOREIGN KEY (audit_type_id) REFERENCES audit_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit_type_audit_task ADD CONSTRAINT FK_2B9244799C94D4F6 FOREIGN KEY (audit_task_id) REFERENCES audit_task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1B85A1111 FOREIGN KEY (super_category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE certification ADD CONSTRAINT FK_6C3C6D7590AF82A5 FOREIGN KEY (certification_type_id) REFERENCES certification_type (id)');
        $this->addSql('ALTER TABLE certification ADD CONSTRAINT FK_6C3C6D751A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE document_tag ADD CONSTRAINT FK_D0234567C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_tag ADD CONSTRAINT FK_D0234567BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audit ADD audit_type_id INT NOT NULL, ADD bill_id INT NOT NULL');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79D46E59E3 FOREIGN KEY (audit_type_id) REFERENCES audit_type (id)');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF791A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id)');
        $this->addSql('CREATE INDEX IDX_9218FF79D46E59E3 ON audit (audit_type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9218FF791A8C12F5 ON audit (bill_id)');
        $this->addSql('ALTER TABLE observation ADD observator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE observation ADD CONSTRAINT FK_C576DBE0F8DCAFD3 FOREIGN KEY (observator_id) REFERENCES collaborator (id)');
        $this->addSql('CREATE INDEX IDX_C576DBE0F8DCAFD3 ON observation (observator_id)');
        $this->addSql('ALTER TABLE user DROP roles');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79D46E59E3');
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF791A8C12F5');
        $this->addSql('ALTER TABLE observation DROP FOREIGN KEY FK_C576DBE0F8DCAFD3');
        $this->addSql('ALTER TABLE audit_type_audit_task DROP FOREIGN KEY FK_2B924479D46E59E3');
        $this->addSql('ALTER TABLE audit_type_audit_task DROP FOREIGN KEY FK_2B9244799C94D4F6');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1B85A1111');
        $this->addSql('ALTER TABLE certification DROP FOREIGN KEY FK_6C3C6D7590AF82A5');
        $this->addSql('ALTER TABLE certification DROP FOREIGN KEY FK_6C3C6D751A8C12F5');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7612469DE2');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76D60322AC');
        $this->addSql('ALTER TABLE document_tag DROP FOREIGN KEY FK_D0234567C33F7837');
        $this->addSql('ALTER TABLE document_tag DROP FOREIGN KEY FK_D0234567BAD26311');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3D60322AC');
        $this->addSql('DROP TABLE audit_type');
        $this->addSql('DROP TABLE audit_type_audit_task');
        $this->addSql('DROP TABLE bill');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE certification');
        $this->addSql('DROP TABLE certification_type');
        $this->addSql('DROP TABLE collaborator');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_tag');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP INDEX IDX_9218FF79D46E59E3 ON audit');
        $this->addSql('DROP INDEX UNIQ_9218FF791A8C12F5 ON audit');
        $this->addSql('ALTER TABLE audit DROP audit_type_id, DROP bill_id');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('DROP INDEX IDX_C576DBE0F8DCAFD3 ON observation');
        $this->addSql('ALTER TABLE observation DROP observator_id');
    }
}
