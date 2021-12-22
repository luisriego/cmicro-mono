<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20211219004909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create the relationship between client and ticket tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ticket ADD client_id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_ticket_client_id FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_ticket_client_id ON ticket (client_id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_user_client_id FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_ticket_client_id');
        $this->addSql('DROP INDEX IDX_ticket_client_id ON ticket');
        $this->addSql('ALTER TABLE ticket DROP client_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_user_client_id');
    }
}
