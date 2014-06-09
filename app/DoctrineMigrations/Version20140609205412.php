<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140609205412 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE gsbm_chat_message (id INT AUTO_INCREMENT NOT NULL, player_id INT DEFAULT NULL, tournament_id INT DEFAULT NULL, date DATETIME NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_12350E2E99E6F5DF (player_id), INDEX IDX_12350E2E33D1A3E7 (tournament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE gsbm_chat_message ADD CONSTRAINT FK_12350E2E99E6F5DF FOREIGN KEY (player_id) REFERENCES gsbm_player (id)");
        $this->addSql("ALTER TABLE gsbm_chat_message ADD CONSTRAINT FK_12350E2E33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES gsbm_tournament (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE gsbm_chat_message");
    }
}
