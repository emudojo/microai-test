<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919023131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_user (item_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(item_id, user_id))');
        $this->addSql('CREATE INDEX IDX_45A392B2126F525E ON item_user (item_id)');
        $this->addSql('CREATE INDEX IDX_45A392B2A76ED395 ON item_user (user_id)');
        $this->addSql('ALTER TABLE item_user ADD CONSTRAINT FK_45A392B2126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_user ADD CONSTRAINT FK_45A392B2A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item DROP CONSTRAINT fk_1f1b251eb03a8386');
        $this->addSql('DROP INDEX uniq_1f1b251eb03a8386');
        $this->addSql('ALTER TABLE item DROP created_by_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE item_user DROP CONSTRAINT FK_45A392B2126F525E');
        $this->addSql('ALTER TABLE item_user DROP CONSTRAINT FK_45A392B2A76ED395');
        $this->addSql('DROP TABLE item_user');
        $this->addSql('ALTER TABLE item ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT fk_1f1b251eb03a8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_1f1b251eb03a8386 ON item (created_by_id)');
    }
}
