<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190316112833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, group_id INT NOT NULL, user_name TINYTEXT NOT NULL, user_email TINYTEXT NOT NULL, user_status enum(\'Active\',\'Inactive\'), created_date DATETIME NOT NULL, INDEX IDX_1483A5E9FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9FE54D947 FOREIGN KEY (group_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category CHANGE category_status category_status enum(\'Active\',\'Inactive\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE category CHANGE category_status category_status VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
