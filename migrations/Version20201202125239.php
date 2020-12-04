<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202125239 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competence_group_competence (competence_id INT NOT NULL, group_competence_id INT NOT NULL, INDEX IDX_B4B3BE6815761DAB (competence_id), INDEX IDX_B4B3BE684A9FD3E9 (group_competence_id), PRIMARY KEY(competence_id, group_competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence_group_competence ADD CONSTRAINT FK_B4B3BE6815761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_group_competence ADD CONSTRAINT FK_B4B3BE684A9FD3E9 FOREIGN KEY (group_competence_id) REFERENCES group_competence (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE group_competence_competence');
        $this->addSql('ALTER TABLE niveau ADD competence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('CREATE INDEX IDX_4BDFF36B15761DAB ON niveau (competence_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE group_competence_competence (group_competence_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_C6C6E39E4A9FD3E9 (group_competence_id), INDEX IDX_C6C6E39E15761DAB (competence_id), PRIMARY KEY(group_competence_id, competence_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE group_competence_competence ADD CONSTRAINT FK_C6C6E39E15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_competence_competence ADD CONSTRAINT FK_C6C6E39E4A9FD3E9 FOREIGN KEY (group_competence_id) REFERENCES group_competence (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE competence_group_competence');
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36B15761DAB');
        $this->addSql('DROP INDEX IDX_4BDFF36B15761DAB ON niveau');
        $this->addSql('ALTER TABLE niveau DROP competence_id');
    }
}
