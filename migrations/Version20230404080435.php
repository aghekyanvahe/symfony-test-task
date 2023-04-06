<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230404080435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atom (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atom_star (atom_id INT NOT NULL, star_id INT NOT NULL, INDEX IDX_1E43E3B96B300498 (atom_id), INDEX IDX_1E43E3B92C3B70D7 (star_id), PRIMARY KEY(atom_id, star_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE galaxy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE star (id INT AUTO_INCREMENT NOT NULL, galaxy_id INT NOT NULL, name VARCHAR(255) NOT NULL, radius DOUBLE PRECISION NOT NULL, temperature DOUBLE PRECISION NOT NULL, rotation_frequency DOUBLE PRECISION NOT NULL, INDEX IDX_C9DB5A14B61FAB2 (galaxy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atom_star ADD CONSTRAINT FK_1E43E3B96B300498 FOREIGN KEY (atom_id) REFERENCES atom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atom_star ADD CONSTRAINT FK_1E43E3B92C3B70D7 FOREIGN KEY (star_id) REFERENCES star (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE star ADD CONSTRAINT FK_C9DB5A14B61FAB2 FOREIGN KEY (galaxy_id) REFERENCES galaxy (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atom_star DROP FOREIGN KEY FK_1E43E3B96B300498');
        $this->addSql('ALTER TABLE atom_star DROP FOREIGN KEY FK_1E43E3B92C3B70D7');
        $this->addSql('ALTER TABLE star DROP FOREIGN KEY FK_C9DB5A14B61FAB2');
        $this->addSql('DROP TABLE atom');
        $this->addSql('DROP TABLE atom_star');
        $this->addSql('DROP TABLE galaxy');
        $this->addSql('DROP TABLE star');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
