<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919205257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_item DROP CONSTRAINT fk_52ea1f0955e38587');
        $this->addSql('DROP INDEX idx_52ea1f0955e38587');
        $this->addSql('ALTER TABLE order_item RENAME COLUMN item_id_id TO item_id');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09126F525E FOREIGN KEY (item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_52EA1F09126F525E ON order_item (item_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE order_item DROP CONSTRAINT FK_52EA1F09126F525E');
        $this->addSql('DROP INDEX IDX_52EA1F09126F525E');
        $this->addSql('ALTER TABLE order_item RENAME COLUMN item_id TO item_id_id');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT fk_52ea1f0955e38587 FOREIGN KEY (item_id_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_52ea1f0955e38587 ON order_item (item_id_id)');
    }
}
