<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220221094250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, gols INT NOT NULL, assist INT NOT NULL, xuts_porta INT NOT NULL, xuts_fora INT NOT NULL, perdues INT NOT NULL, recuperacions INT NOT NULL, intercepcions INT NOT NULL, partits INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partit (id INT AUTO_INCREMENT NOT NULL, gols INT NOT NULL, assist INT NOT NULL, xuts_porta INT NOT NULL, xuts_fora INT NOT NULL, perdues INT NOT NULL, recuperacions INT NOT NULL, intercepcions INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE partit');
    }
}
