<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220305154247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artiste_film (artiste_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_1A8CDAA121D25844 (artiste_id), INDEX IDX_1A8CDAA1567F5183 (film_id), PRIMARY KEY(artiste_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(100) NOT NULL, date_sortie DATETIME NOT NULL, affiche VARCHAR(255) DEFAULT NULL, synopsis VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisateur (id INT AUTO_INCREMENT NOT NULL, artiste_id INT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_47933EFE21D25844 (artiste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artiste_film ADD CONSTRAINT FK_1A8CDAA121D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_film ADD CONSTRAINT FK_1A8CDAA1567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE realisateur ADD CONSTRAINT FK_47933EFE21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste_film DROP FOREIGN KEY FK_1A8CDAA121D25844');
        $this->addSql('ALTER TABLE realisateur DROP FOREIGN KEY FK_47933EFE21D25844');
        $this->addSql('ALTER TABLE artiste_film DROP FOREIGN KEY FK_1A8CDAA1567F5183');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE artiste_film');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE realisateur');
    }
}
