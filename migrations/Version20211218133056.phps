<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20211218133056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates the user-client relationship';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD client_id CHAR(36) NOT NULL');
//        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_user_client_id FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_user_client_id ON user (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_user_client_id');
//        $this->addSql('DROP INDEX IDX_user_client_id ON user');
        $this->addSql('ALTER TABLE user DROP client_id');
    }
}
