<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190919132359 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE poep');
        $this->addSql('ALTER TABLE article ADD author VARCHAR(255) NOT NULL, ADD heart_count INT NOT NULL, ADD image_filename VARCHAR(255) DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE poep (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_417F1D432B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article DROP author, DROP heart_count, DROP image_filename, CHANGE published_at published_at DATETIME DEFAULT \'NULL\'');
    }
}
