<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211222123538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id CHAR(36) NOT NULL, company_name VARCHAR(150) NOT NULL, cnpj VARCHAR(14) NOT NULL, avatar VARCHAR(250) DEFAULT NULL, visible TINYINT(1) NOT NULL, x_rays VARCHAR(255) DEFAULT NULL, created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, updated_on DATETIME NOT NULL, UNIQUE INDEX U_client_cnpj (cnpj), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id CHAR(36) NOT NULL, client_id CHAR(36) NOT NULL, message VARCHAR(255) NOT NULL, created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, updated_on DATETIME NOT NULL, ended_on DATETIME DEFAULT NULL, INDEX IDX_ticket_client_id (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL, client_id CHAR(36) NOT NULL, name VARCHAR(20) NOT NULL, surname VARCHAR(30) DEFAULT NULL, email VARCHAR(100) NOT NULL, roles JSON NOT NULL, password VARCHAR(100) DEFAULT NULL, code CHAR(40), avatar VARCHAR(255) DEFAULT NULL, is_active TINYINT NOT NULL DEFAULT \'1\', created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, updated_on DATETIME NOT NULL, INDEX IDX_user_client_id (client_id), UNIQUE INDEX U_user_email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_ticket_client_id FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_user_client_id FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_ticket_client_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_user_client_id');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE user');
    }
}
