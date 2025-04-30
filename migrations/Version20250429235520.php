<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250429235520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE vol_utilisateur DROP FOREIGN KEY FK_850142E19F2BFB7A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol_utilisateur DROP FOREIGN KEY FK_850142E1FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vol_utilisateur
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE vol_utilisateur (vol_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_850142E19F2BFB7A (vol_id), INDEX IDX_850142E1FB88E14F (utilisateur_id), PRIMARY KEY(vol_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol_utilisateur ADD CONSTRAINT FK_850142E19F2BFB7A FOREIGN KEY (vol_id) REFERENCES vol (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol_utilisateur ADD CONSTRAINT FK_850142E1FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
    }
}
