<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250430023022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE conges ADD ref_pilote_id INT DEFAULT NULL, ADD ref_validation_admin_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges ADD CONSTRAINT FK_6327DE3A864AABAC FOREIGN KEY (ref_pilote_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges ADD CONSTRAINT FK_6327DE3AF50CD755 FOREIGN KEY (ref_validation_admin_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6327DE3A864AABAC ON conges (ref_pilote_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6327DE3AF50CD755 ON conges (ref_validation_admin_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD ref_user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955637A8045 FOREIGN KEY (ref_user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_42C84955637A8045 ON reservation (ref_user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD ref_modele_id INT DEFAULT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD date_naissance DATE NOT NULL, ADD ville VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D649DF4EB64F FOREIGN KEY (ref_modele_id) REFERENCES modele (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8D93D649DF4EB64F ON user (ref_modele_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol ADD ref_pilote_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol ADD CONSTRAINT FK_95C97EB864AABAC FOREIGN KEY (ref_pilote_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_95C97EB864AABAC ON vol (ref_pilote_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955637A8045
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_42C84955637A8045 ON reservation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP ref_user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges DROP FOREIGN KEY FK_6327DE3A864AABAC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges DROP FOREIGN KEY FK_6327DE3AF50CD755
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_6327DE3A864AABAC ON conges
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_6327DE3AF50CD755 ON conges
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges DROP ref_pilote_id, DROP ref_validation_admin_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DF4EB64F
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8D93D649DF4EB64F ON user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP ref_modele_id, DROP nom, DROP prenom, DROP date_naissance, DROP ville
        SQL);
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
