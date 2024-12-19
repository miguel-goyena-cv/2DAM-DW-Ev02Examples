<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241219120711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FC54C8C93 FOREIGN KEY (type_id) REFERENCES restaurant_type (id)');
        $this->addSql('CREATE INDEX IDX_EB95123FC54C8C93 ON restaurant (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FC54C8C93');
        $this->addSql('DROP INDEX IDX_EB95123FC54C8C93 ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP type_id');
    }
}
