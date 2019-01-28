<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190128053150 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dit_devis DROP FOREIGN KEY FK_80D803BA993E31E6');
        $this->addSql('ALTER TABLE dit_service_client DROP FOREIGN KEY FK_6055A35D993E31E6');
        $this->addSql('ALTER TABLE dit_service_client DROP FOREIGN KEY FK_6055A35DEF31D215');
        $this->addSql('ALTER TABLE dit_service_service_option DROP FOREIGN KEY FK_3F25616BEF31D215');
        $this->addSql('ALTER TABLE dit_facture DROP FOREIGN KEY FK_E4DBB331D2D022FA');
        $this->addSql('ALTER TABLE dit_service_client_jointe DROP FOREIGN KEY FK_9E4FA189D2D022FA');
        $this->addSql('ALTER TABLE dit_service_client_service_option DROP FOREIGN KEY FK_C42E94BCD2D022FA');
        $this->addSql('ALTER TABLE dit_user_service_client DROP FOREIGN KEY FK_42F27182D2D022FA');
        $this->addSql('ALTER TABLE dit_service_client_service_option DROP FOREIGN KEY FK_C42E94BC29802');
        $this->addSql('ALTER TABLE dit_service_service_option DROP FOREIGN KEY FK_3F25616B29802');
        $this->addSql('ALTER TABLE dit_service_option DROP FOREIGN KEY FK_FD97A7B87558E39B');
        $this->addSql('ALTER TABLE dit_service_option DROP FOREIGN KEY FK_FD97A7B8F53CECDF');
        $this->addSql('ALTER TABLE dit_service DROP FOREIGN KEY FK_FBC04DF3D9779018');
        $this->addSql('ALTER TABLE dit_user_service_client_tester DROP FOREIGN KEY FK_D97D07F2D1DE38C2');
        $this->addSql('ALTER TABLE dit_user_service_client_user DROP FOREIGN KEY FK_BC1C0860D1DE38C2');
        $this->addSql('DROP TABLE dit_client');
        $this->addSql('DROP TABLE dit_devis');
        $this->addSql('DROP TABLE dit_facture');
        $this->addSql('DROP TABLE dit_service');
        $this->addSql('DROP TABLE dit_service_client');
        $this->addSql('DROP TABLE dit_service_client_jointe');
        $this->addSql('DROP TABLE dit_service_client_service_option');
        $this->addSql('DROP TABLE dit_service_option');
        $this->addSql('DROP TABLE dit_service_option_type');
        $this->addSql('DROP TABLE dit_service_option_valeur_type');
        $this->addSql('DROP TABLE dit_service_service_option');
        $this->addSql('DROP TABLE dit_service_type');
        $this->addSql('DROP TABLE dit_user_service_client');
        $this->addSql('DROP TABLE dit_user_service_client_tester');
        $this->addSql('DROP TABLE dit_user_service_client_user');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dit_client (id INT AUTO_INCREMENT NOT NULL, clt_name VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, clt_firstname VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, clt_address VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, clt_tel VARCHAR(45) DEFAULT NULL COLLATE utf8_unicode_ci, clt_mdp VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, clt_is_valid TINYINT(1) NOT NULL, clt_nom_entreprise VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, clt_last_connected DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_devis (id INT AUTO_INCREMENT NOT NULL, dit_clt_id INT DEFAULT NULL, dit_usr_id INT DEFAULT NULL, dv_sujet VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, dv_desc LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, dv_date DATETIME DEFAULT NULL, dv_pj VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, INDEX IDX_80D803BA993E31E6 (dit_clt_id), INDEX IDX_80D803BA8B6A8FEF (dit_usr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_facture (id INT AUTO_INCREMENT NOT NULL, dit_srv_clt_id INT DEFAULT NULL, fct_date DATETIME DEFAULT NULL, fct_status SMALLINT DEFAULT NULL, INDEX IDX_E4DBB331D2D022FA (dit_srv_clt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_service (id INT AUTO_INCREMENT NOT NULL, dit_srv_tp_id INT DEFAULT NULL, srv_label VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, srv_desc LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, srv_prix DOUBLE PRECISION DEFAULT NULL, srv_reduction DOUBLE PRECISION DEFAULT NULL, srv_slug VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_FBC04DF3D9779018 (dit_srv_tp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_service_client (id INT AUTO_INCREMENT NOT NULL, dit_srv_id INT DEFAULT NULL, dit_clt_id INT DEFAULT NULL, dit_usr_id INT DEFAULT NULL, srv_clt_is_payed TINYINT(1) DEFAULT NULL, srv_clt_payment_type VARCHAR(45) DEFAULT NULL COLLATE utf8_unicode_ci, srv_clt_payment_is_facture TINYINT(1) DEFAULT NULL, srv_clt_project_link VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, srv_clt_date DATETIME DEFAULT NULL, srv_clt_date_livraison_prev DATETIME DEFAULT NULL, srv_clt_date_livraison DATETIME DEFAULT NULL, srv_clt_desc LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, srv_clt_lien_code_source VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, srv_clt_lien_livre VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, srv_clt_nbr_page INT DEFAULT NULL, srv_clt_nbr_page_decline INT DEFAULT NULL, srv_clt_prix DOUBLE PRECISION DEFAULT NULL, srv_clt_status_validation SMALLINT DEFAULT 0, srv_clt_status_project SMALLINT DEFAULT 0, INDEX IDX_6055A35DEF31D215 (dit_srv_id), INDEX IDX_6055A35D993E31E6 (dit_clt_id), INDEX IDX_6055A35D8B6A8FEF (dit_usr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_service_client_jointe (id INT AUTO_INCREMENT NOT NULL, dit_srv_clt_id INT DEFAULT NULL, srv_clt_jt_ext VARCHAR(10) DEFAULT NULL COLLATE utf8_unicode_ci, srv_clt_jt_path VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, INDEX IDX_9E4FA189D2D022FA (dit_srv_clt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_service_client_service_option (dit_srv_clt_id INT NOT NULL, dit_srv_opt_id INT NOT NULL, INDEX IDX_C42E94BCD2D022FA (dit_srv_clt_id), INDEX IDX_C42E94BC29802 (dit_srv_opt_id), PRIMARY KEY(dit_srv_clt_id, dit_srv_opt_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_service_option (id INT AUTO_INCREMENT NOT NULL, dit_srv_opt_tp_id INT DEFAULT NULL, dit_srv_opt_val_tp_id INT DEFAULT NULL, srv_opt_label VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, srv_opt_desc LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, srv_opt_type VARCHAR(45) DEFAULT NULL COLLATE utf8_unicode_ci, srv_opt_valeur DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_FD97A7B8F53CECDF (dit_srv_opt_val_tp_id), INDEX IDX_FD97A7B87558E39B (dit_srv_opt_tp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_service_option_type (id INT AUTO_INCREMENT NOT NULL, srv_opt_tp_label VARCHAR(45) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_service_option_valeur_type (id INT AUTO_INCREMENT NOT NULL, srv_opt_val_tp_is_percent TINYINT(1) DEFAULT NULL, srv_opt_val_tp_is_reduction TINYINT(1) DEFAULT NULL, srv_opt_val_tp_is_gratuit TINYINT(1) DEFAULT NULL, srv_opt_val_tp_val SMALLINT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_service_service_option (dit_srv_id INT NOT NULL, dit_srv_opt_id INT NOT NULL, INDEX IDX_3F25616BEF31D215 (dit_srv_id), INDEX IDX_3F25616B29802 (dit_srv_opt_id), PRIMARY KEY(dit_srv_id, dit_srv_opt_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_service_type (id INT AUTO_INCREMENT NOT NULL, srv_tp_label VARCHAR(45) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_user_service_client (id INT AUTO_INCREMENT NOT NULL, dit_usr_admin_id INT DEFAULT NULL, dit_srv_clt_id INT DEFAULT NULL, usr_srv_clt_date_debut DATETIME DEFAULT NULL, usr_srv_clt_date_attribution DATETIME DEFAULT NULL, usr_srv_clt_estimation DOUBLE PRECISION DEFAULT NULL, usr_srv_clt_date_finalisation DATETIME DEFAULT NULL, INDEX IDX_42F271826DC942AE (dit_usr_admin_id), INDEX IDX_42F27182D2D022FA (dit_srv_clt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_user_service_client_tester (dit_usr_srv_clt_id INT NOT NULL, dit_tst_id INT NOT NULL, INDEX IDX_D97D07F2D1DE38C2 (dit_usr_srv_clt_id), INDEX IDX_D97D07F2655D0396 (dit_tst_id), PRIMARY KEY(dit_usr_srv_clt_id, dit_tst_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dit_user_service_client_user (dit_usr_srv_clt_id INT NOT NULL, dit_usr_id INT NOT NULL, INDEX IDX_BC1C0860D1DE38C2 (dit_usr_srv_clt_id), INDEX IDX_BC1C08608B6A8FEF (dit_usr_id), PRIMARY KEY(dit_usr_srv_clt_id, dit_usr_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dit_devis ADD CONSTRAINT FK_80D803BA8B6A8FEF FOREIGN KEY (dit_usr_id) REFERENCES dit_user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE dit_devis ADD CONSTRAINT FK_80D803BA993E31E6 FOREIGN KEY (dit_clt_id) REFERENCES dit_client (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE dit_facture ADD CONSTRAINT FK_E4DBB331D2D022FA FOREIGN KEY (dit_srv_clt_id) REFERENCES dit_service_client (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE dit_service ADD CONSTRAINT FK_FBC04DF3D9779018 FOREIGN KEY (dit_srv_tp_id) REFERENCES dit_service_type (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE dit_service_client ADD CONSTRAINT FK_6055A35D8B6A8FEF FOREIGN KEY (dit_usr_id) REFERENCES dit_user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE dit_service_client ADD CONSTRAINT FK_6055A35D993E31E6 FOREIGN KEY (dit_clt_id) REFERENCES dit_client (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE dit_service_client ADD CONSTRAINT FK_6055A35DEF31D215 FOREIGN KEY (dit_srv_id) REFERENCES dit_service (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE dit_service_client_jointe ADD CONSTRAINT FK_9E4FA189D2D022FA FOREIGN KEY (dit_srv_clt_id) REFERENCES dit_service_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dit_service_client_service_option ADD CONSTRAINT FK_C42E94BC29802 FOREIGN KEY (dit_srv_opt_id) REFERENCES dit_service_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dit_service_client_service_option ADD CONSTRAINT FK_C42E94BCD2D022FA FOREIGN KEY (dit_srv_clt_id) REFERENCES dit_service_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dit_service_option ADD CONSTRAINT FK_FD97A7B87558E39B FOREIGN KEY (dit_srv_opt_tp_id) REFERENCES dit_service_option_type (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE dit_service_option ADD CONSTRAINT FK_FD97A7B8F53CECDF FOREIGN KEY (dit_srv_opt_val_tp_id) REFERENCES dit_service_option_valeur_type (id)');
        $this->addSql('ALTER TABLE dit_service_service_option ADD CONSTRAINT FK_3F25616B29802 FOREIGN KEY (dit_srv_opt_id) REFERENCES dit_service_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dit_service_service_option ADD CONSTRAINT FK_3F25616BEF31D215 FOREIGN KEY (dit_srv_id) REFERENCES dit_service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dit_user_service_client ADD CONSTRAINT FK_42F271826DC942AE FOREIGN KEY (dit_usr_admin_id) REFERENCES dit_user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE dit_user_service_client ADD CONSTRAINT FK_42F27182D2D022FA FOREIGN KEY (dit_srv_clt_id) REFERENCES dit_service_client (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE dit_user_service_client_tester ADD CONSTRAINT FK_D97D07F2655D0396 FOREIGN KEY (dit_tst_id) REFERENCES dit_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dit_user_service_client_tester ADD CONSTRAINT FK_D97D07F2D1DE38C2 FOREIGN KEY (dit_usr_srv_clt_id) REFERENCES dit_user_service_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dit_user_service_client_user ADD CONSTRAINT FK_BC1C08608B6A8FEF FOREIGN KEY (dit_usr_id) REFERENCES dit_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dit_user_service_client_user ADD CONSTRAINT FK_BC1C0860D1DE38C2 FOREIGN KEY (dit_usr_srv_clt_id) REFERENCES dit_user_service_client (id) ON DELETE CASCADE');
    }
}
