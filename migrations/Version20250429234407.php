<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250429234407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE vol_utilisateur (vol_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_850142E19F2BFB7A (vol_id), INDEX IDX_850142E1FB88E14F (utilisateur_id), PRIMARY KEY(vol_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol_utilisateur ADD CONSTRAINT FK_850142E19F2BFB7A FOREIGN KEY (vol_id) REFERENCES vol (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol_utilisateur ADD CONSTRAINT FK_850142E1FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE avion ADD ref_modele_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE avion ADD CONSTRAINT FK_234D9D38DF4EB64F FOREIGN KEY (ref_modele_id) REFERENCES modele (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_234D9D38DF4EB64F ON avion (ref_modele_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges ADD ref_pilote_id INT DEFAULT NULL, ADD ref_validation_admin_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges ADD CONSTRAINT FK_6327DE3A864AABAC FOREIGN KEY (ref_pilote_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conges ADD CONSTRAINT FK_6327DE3AF50CD755 FOREIGN KEY (ref_validation_admin_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6327DE3A864AABAC ON conges (ref_pilote_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6327DE3AF50CD755 ON conges (ref_validation_admin_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD ref_utilisateur_id INT DEFAULT NULL, ADD ref_vol_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B61ED040 FOREIGN KEY (ref_utilisateur_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955EA329383 FOREIGN KEY (ref_vol_id) REFERENCES vol (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_42C84955B61ED040 ON reservation (ref_utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_42C84955EA329383 ON reservation (ref_vol_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur ADD ref_modele_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3DF4EB64F FOREIGN KEY (ref_modele_id) REFERENCES modele (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1D1C63B3DF4EB64F ON utilisateur (ref_modele_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol ADD ref_avion_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol ADD CONSTRAINT FK_95C97EB6AC7EC6 FOREIGN KEY (ref_avion_id) REFERENCES avion (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_95C97EB6AC7EC6 ON vol (ref_avion_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE vol_utilisateur DROP FOREIGN KEY FK_850142E19F2BFB7A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol_utilisateur DROP FOREIGN KEY FK_850142E1FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vol_utilisateur
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE avion DROP FOREIGN KEY FK_234D9D38DF4EB64F
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_234D9D38DF4EB64F ON avion
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE avion DROP ref_modele_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B61ED040
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955EA329383
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_42C84955B61ED040 ON reservation
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_42C84955EA329383 ON reservation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP ref_utilisateur_id, DROP ref_vol_id
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
            ALTER TABLE vol DROP FOREIGN KEY FK_95C97EB6AC7EC6
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_95C97EB6AC7EC6 ON vol
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vol DROP ref_avion_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3DF4EB64F
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1D1C63B3DF4EB64F ON utilisateur
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur DROP ref_modele_id
        SQL);
    }
}
