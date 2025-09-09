<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250909140940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listing ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE listing ADD CONSTRAINT FK_CB0048D49D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CB0048D49D86650F ON listing (user_id_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D4619D1A');
        $this->addSql('DROP INDEX IDX_8D93D649D4619D1A ON user');
        $this->addSql('ALTER TABLE user DROP listing_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listing DROP FOREIGN KEY FK_CB0048D49D86650F');
        $this->addSql('DROP INDEX IDX_CB0048D49D86650F ON listing');
        $this->addSql('ALTER TABLE listing DROP user_id_id');
        $this->addSql('ALTER TABLE user ADD listing_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D4619D1A FOREIGN KEY (listing_id) REFERENCES listing (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D4619D1A ON user (listing_id)');
    }
}
