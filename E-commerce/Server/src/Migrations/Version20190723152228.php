<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190723152228 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE variants');
        $this->addSql('ALTER TABLE article ADD picture VARCHAR(255) DEFAULT NULL, DROP description');
        $this->addSql('ALTER TABLE category CHANGE picture picture VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, name JSON NOT NULL, INDEX IDX_16DB4F897294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE variants (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, price INT NOT NULL, color VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, mark VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, stock VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, memory_size VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, screen_size VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, capacity INT DEFAULT NULL, weight_of_article INT DEFAULT NULL, operating_system VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_B39853E17294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F897294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE variants ADD CONSTRAINT FK_B39853E17294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article ADD description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP picture');
        $this->addSql('ALTER TABLE category CHANGE picture picture LONGBLOB DEFAULT NULL');
    }
}
