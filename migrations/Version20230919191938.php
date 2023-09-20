<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919191938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item ALTER stock DROP DEFAULT');
        $this->addSql('ALTER TABLE order_item DROP CONSTRAINT FK_52EA1F09FCDAEAAA');
        $this->addSql('DROP INDEX uniq_52ea1f09fcdaeaaa');
        $this->addSql('ALTER TABLE order_item ADD item_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F0955E38587 FOREIGN KEY (item_id_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_52EA1F09FCDAEAAA ON order_item (order_id_id)');
        $this->addSql('CREATE INDEX IDX_52EA1F0955E38587 ON order_item (item_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE item ALTER stock SET DEFAULT 0');
        $this->addSql('ALTER TABLE order_item DROP CONSTRAINT FK_52EA1F0955E38587');
        $this->addSql('ALTER TABLE order_item DROP CONSTRAINT fk_52ea1f09fcdaeaaa');
        $this->addSql('DROP INDEX IDX_52EA1F09FCDAEAAA');
        $this->addSql('DROP INDEX IDX_52EA1F0955E38587');
        $this->addSql('ALTER TABLE order_item DROP item_id_id');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT fk_52ea1f09fcdaeaaa FOREIGN KEY (order_id_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_52ea1f09fcdaeaaa ON order_item (order_id_id)');
    }
}
