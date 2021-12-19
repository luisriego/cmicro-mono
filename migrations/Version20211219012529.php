<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20211219012529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `employee` table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE employee (id CHAR(36) NOT NULL, cpf VARCHAR(14) NOT NULL, is_active TINYINT(1) NOT NULL, created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, updated_on DATETIME NOT NULL, UNIQUE INDEX U_employee_cpf (cpf), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE employee');
    }
}
