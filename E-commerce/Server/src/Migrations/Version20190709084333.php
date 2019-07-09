<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190709084333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE variants (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, price INT NOT NULL, color VARCHAR(255) NOT NULL, mark VARCHAR(255) NOT NULL, stock VARCHAR(255) NOT NULL, memory_size VARCHAR(255) DEFAULT NULL, screen_size VARCHAR(255) DEFAULT NULL, capacity INT DEFAULT NULL, weight_of_article INT DEFAULT NULL, operating_system VARCHAR(255) DEFAULT NULL, INDEX IDX_B39853E17294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE variants ADD CONSTRAINT FK_B39853E17294869C FOREIGN KEY (article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE variants');
    }
}
