<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190724141015 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, stock_enter INT DEFAULT NULL, stock_left INT DEFAULT NULL, final_stock INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_produit (stock_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_3003FC84DCD6110 (stock_id), INDEX IDX_3003FC84F347EFB (produit_id), PRIMARY KEY(stock_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stock_produit ADD CONSTRAINT FK_3003FC84DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock_produit ADD CONSTRAINT FK_3003FC84F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE variant ADD price INT NOT NULL, ADD mark VARCHAR(255) DEFAULT NULL, ADD color VARCHAR(255) DEFAULT NULL, ADD capacity VARCHAR(255) DEFAULT NULL, ADD screen_size VARCHAR(255) DEFAULT NULL, ADD memory_size VARCHAR(255) DEFAULT NULL, ADD weight_of_article VARCHAR(255) DEFAULT NULL, ADD operating_system VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE stock_produit DROP FOREIGN KEY FK_3003FC84DCD6110');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE stock_produit');
        $this->addSql('ALTER TABLE variant DROP price, DROP mark, DROP color, DROP capacity, DROP screen_size, DROP memory_size, DROP weight_of_article, DROP operating_system');
    }
}
