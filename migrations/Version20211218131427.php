<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20211218131427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates the `client` table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE client (id CHAR(36) NOT NULL, company_name VARCHAR(150) NOT NULL, cnpj VARCHAR(14) NOT NULL, avatar VARCHAR(250) DEFAULT NULL, visible TINYINT(1) NOT NULL, x_rays VARCHAR(255) DEFAULT NULL, created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, updated_on DATETIME NOT NULL, UNIQUE INDEX U_client_cnpj (cnpj), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE client');
    }
}
