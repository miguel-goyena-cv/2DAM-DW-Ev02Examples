<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241201185424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE restaurant_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE restaurant ADD rest_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FF630FDBB FOREIGN KEY (rest_type_id) REFERENCES restaurant_type (id)');
        $this->addSql('CREATE INDEX IDX_EB95123FF630FDBB ON restaurant (rest_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FF630FDBB');
        $this->addSql('DROP TABLE restaurant_type');
        $this->addSql('DROP INDEX IDX_EB95123FF630FDBB ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP rest_type_id');
    }
}
