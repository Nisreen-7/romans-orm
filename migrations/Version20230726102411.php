<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230726102411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_a DATE NOT NULL, categorie VARCHAR(255) NOT NULL, statue_a VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_F65593E5FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande (id INT AUTO_INCREMENT NOT NULL, utilisature_id INT NOT NULL, annonce_id INT NOT NULL, date_debut DATE NOT NULL, date_retour DATE NOT NULL, raison LONGTEXT NOT NULL, statue_d VARCHAR(255) NOT NULL, INDEX IDX_2694D7A587B050E2 (utilisature_id), INDEX IDX_2694D7A58805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A587B050E2 FOREIGN KEY (utilisature_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A58805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5FB88E14F');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A587B050E2');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A58805AB2F');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
