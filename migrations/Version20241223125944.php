<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241223125944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stuecke ADD interpreter_name VARCHAR(255) DEFAULT NULL, ADD bearbeiter_name VARCHAR(255) DEFAULT NULL, CHANGE stueck_art stueck_art VARCHAR(255) NOT NULL, CHANGE interpreter_id interpreter_id INT DEFAULT NULL, CHANGE bearbeiter_id bearbeiter_id INT DEFAULT NULL, CHANGE jugenzug_stueck jugendzug_stueck TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE stuecke ADD CONSTRAINT FK_1CD56053AD59FFB1 FOREIGN KEY (interpreter_id) REFERENCES interpreter (id)');
        $this->addSql('ALTER TABLE stuecke ADD CONSTRAINT FK_1CD56053DF2BE3C6 FOREIGN KEY (bearbeiter_id) REFERENCES bearbeiter (id)');
        $this->addSql('CREATE INDEX IDX_1CD56053AD59FFB1 ON stuecke (interpreter_id)');
        $this->addSql('CREATE INDEX IDX_1CD56053DF2BE3C6 ON stuecke (bearbeiter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stuecke DROP FOREIGN KEY FK_1CD56053AD59FFB1');
        $this->addSql('ALTER TABLE stuecke DROP FOREIGN KEY FK_1CD56053DF2BE3C6');
        $this->addSql('DROP INDEX IDX_1CD56053AD59FFB1 ON stuecke');
        $this->addSql('DROP INDEX IDX_1CD56053DF2BE3C6 ON stuecke');
        $this->addSql('ALTER TABLE stuecke DROP interpreter_name, DROP bearbeiter_name, CHANGE interpreter_id interpreter_id INT NOT NULL, CHANGE bearbeiter_id bearbeiter_id INT NOT NULL, CHANGE stueck_art stueck_art TINYINT(1) NOT NULL, CHANGE jugendzug_stueck jugenzug_stueck TINYINT(1) NOT NULL');
    }
}
