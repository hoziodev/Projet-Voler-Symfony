<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250508213301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE token ADD ref_user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE token ADD CONSTRAINT FK_5F37A13B637A8045 FOREIGN KEY (ref_user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_5F37A13B637A8045 ON token (ref_user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE token DROP FOREIGN KEY FK_5F37A13B637A8045
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_5F37A13B637A8045 ON token
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE token DROP ref_user_id
        SQL);
    }
}
