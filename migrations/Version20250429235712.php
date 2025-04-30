<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250429235712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE vol ADD ref_pilote_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol ADD CONSTRAINT FK_95C97EB864AABAC FOREIGN KEY (ref_pilote_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_95C97EB864AABAC ON vol (ref_pilote_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE vol DROP FOREIGN KEY FK_95C97EB864AABAC
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_95C97EB864AABAC ON vol
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol DROP ref_pilote_id
        SQL);
    }
}
