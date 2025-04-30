<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250430022007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE conges DROP FOREIGN KEY FK_6327DE3A864AABAC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges DROP FOREIGN KEY FK_6327DE3AF50CD755
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B61ED040
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol DROP FOREIGN KEY FK_95C97EB864AABAC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3DF4EB64F
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE utilisateur
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
            DROP INDEX IDX_42C84955B61ED040 ON reservation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP ref_utilisateur_id
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_95C97EB864AABAC ON vol
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol DROP ref_pilote_id
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, ref_modele_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mot_de_passe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_naissance DATE NOT NULL, ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT 'ROLE_USER' COLLATE `utf8mb4_unicode_ci`, INDEX IDX_1D1C63B3DF4EB64F (ref_modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3DF4EB64F FOREIGN KEY (ref_modele_id) REFERENCES modele (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges ADD ref_pilote_id INT DEFAULT NULL, ADD ref_validation_admin_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges ADD CONSTRAINT FK_6327DE3A864AABAC FOREIGN KEY (ref_pilote_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges ADD CONSTRAINT FK_6327DE3AF50CD755 FOREIGN KEY (ref_validation_admin_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6327DE3A864AABAC ON conges (ref_pilote_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6327DE3AF50CD755 ON conges (ref_validation_admin_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD ref_utilisateur_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B61ED040 FOREIGN KEY (ref_utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_42C84955B61ED040 ON reservation (ref_utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol ADD ref_pilote_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol ADD CONSTRAINT FK_95C97EB864AABAC FOREIGN KEY (ref_pilote_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_95C97EB864AABAC ON vol (ref_pilote_id)
        SQL);
    }
}
