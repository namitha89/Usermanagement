<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190319175626 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE category_status category_status enum(\'Active\',\'Inactive\')');
        $this->addSql('ALTER TABLE users CHANGE user_status user_status enum(\'Active\',\'Inactive\')');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9550872C ON users (user_email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE category_status category_status VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX UNIQ_1483A5E9550872C ON users');
        $this->addSql('ALTER TABLE users CHANGE user_status user_status VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
