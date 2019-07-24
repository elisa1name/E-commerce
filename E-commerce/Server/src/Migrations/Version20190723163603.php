<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190723163603 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE variant (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE variant_produit (variant_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_4600C1613B69A9AF (variant_id), INDEX IDX_4600C161F347EFB (produit_id), PRIMARY KEY(variant_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_29A5EC277294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture_produit (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, name JSON DEFAULT NULL, INDEX IDX_348318F5F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE variant_produit ADD CONSTRAINT FK_4600C1613B69A9AF FOREIGN KEY (variant_id) REFERENCES variant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE variant_produit ADD CONSTRAINT FK_4600C161F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC277294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE picture_produit ADD CONSTRAINT FK_348318F5F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE variants');
        $this->addSql('ALTER TABLE article ADD picture VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE variant_produit DROP FOREIGN KEY FK_4600C1613B69A9AF');
        $this->addSql('ALTER TABLE variant_produit DROP FOREIGN KEY FK_4600C161F347EFB');
        $this->addSql('ALTER TABLE picture_produit DROP FOREIGN KEY FK_348318F5F347EFB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, name JSON NOT NULL, INDEX IDX_16DB4F897294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE variants (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, price INT NOT NULL, color VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, mark VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, stock VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, memory_size VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, screen_size VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, capacity INT DEFAULT NULL, weight_of_article INT DEFAULT NULL, operating_system VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_B39853E17294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F897294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE variants ADD CONSTRAINT FK_B39853E17294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('DROP TABLE variant');
        $this->addSql('DROP TABLE variant_produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE picture_produit');
        $this->addSql('ALTER TABLE article DROP picture');
    }
}
