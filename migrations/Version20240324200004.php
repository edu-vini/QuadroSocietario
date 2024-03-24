<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324200004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE access_token (access_token VARCHAR(255) NOT NULL, usuario_id INT DEFAULT NULL, criado_em TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, valido_ate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(access_token))');
        $this->addSql('CREATE INDEX IDX_B6A2DD68DB38439E ON access_token (usuario_id)');
        $this->addSql('ALTER TABLE access_token ADD CONSTRAINT FK_B6A2DD68DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE access_token DROP CONSTRAINT FK_B6A2DD68DB38439E');
        $this->addSql('DROP TABLE access_token');
    }
}
