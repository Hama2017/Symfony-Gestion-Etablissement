<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250316143133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE commentaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE etablissement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE commentaire (id INT NOT NULL, etablissement_id INT NOT NULL, auteur VARCHAR(255) NOT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, note INT NOT NULL, texte TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_67F068BCFF631228 ON commentaire (etablissement_id)');
        $this->addSql('CREATE TABLE etablissement (id INT NOT NULL, numero_uai VARCHAR(10) NOT NULL, appellation_officielle VARCHAR(255) DEFAULT NULL, denomination_principale VARCHAR(255) DEFAULT NULL, patronyme VARCHAR(255) DEFAULT NULL, secteur VARCHAR(10) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(10) DEFAULT NULL, commune VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, nature_uai_libelle VARCHAR(255) DEFAULT NULL, nature_uai_code INT DEFAULT NULL, etat_etablissement VARCHAR(20) NOT NULL, code_departement VARCHAR(10) DEFAULT NULL, departement VARCHAR(255) DEFAULT NULL, code_region VARCHAR(10) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, code_academie VARCHAR(10) DEFAULT NULL, academie VARCHAR(255) DEFAULT NULL, date_ouverture DATE DEFAULT NULL, sigle VARCHAR(20) DEFAULT NULL, code_commune VARCHAR(10) DEFAULT NULL, code_ministere VARCHAR(10) DEFAULT NULL, ministere VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_20FD592CD0A47604 ON etablissement (numero_uai)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE commentaire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE etablissement_id_seq CASCADE');
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BCFF631228');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
