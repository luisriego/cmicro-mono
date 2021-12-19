<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20211219012921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Employee table realtionship with user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE employee ADD user_id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_employee_user_ìd FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX U_employee_user_id ON employee (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_employee_user_ìd');
        $this->addSql('DROP INDEX U_employee_user_id ON employee');
        $this->addSql('ALTER TABLE employee DROP user_id');
    }
}
