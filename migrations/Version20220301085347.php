<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301085347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE firstname DROP FOREIGN KEY FK_83A00E68F675F31B');
        $this->addSql('DROP INDEX IDX_83A00E68F675F31B ON firstname');
        $this->addSql('ALTER TABLE firstname CHANGE author_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE firstname ADD CONSTRAINT FK_83A00E68A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_83A00E68A76ED395 ON firstname (user_id)');
        $this->addSql('ALTER TABLE lastname DROP FOREIGN KEY FK_3124B5B6F675F31B');
        $this->addSql('DROP INDEX IDX_3124B5B6F675F31B ON lastname');
        $this->addSql('ALTER TABLE lastname CHANGE author_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE lastname ADD CONSTRAINT FK_3124B5B6A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_3124B5B6A76ED395 ON lastname (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE firstname DROP FOREIGN KEY FK_83A00E68A76ED395');
        $this->addSql('DROP INDEX IDX_83A00E68A76ED395 ON firstname');
        $this->addSql('ALTER TABLE firstname CHANGE label label VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE user_id author_id INT NOT NULL');
        $this->addSql('ALTER TABLE firstname ADD CONSTRAINT FK_83A00E68F675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_83A00E68F675F31B ON firstname (author_id)');
        $this->addSql('ALTER TABLE lastname DROP FOREIGN KEY FK_3124B5B6A76ED395');
        $this->addSql('DROP INDEX IDX_3124B5B6A76ED395 ON lastname');
        $this->addSql('ALTER TABLE lastname CHANGE label label VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE user_id author_id INT NOT NULL');
        $this->addSql('ALTER TABLE lastname ADD CONSTRAINT FK_3124B5B6F675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3124B5B6F675F31B ON lastname (author_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `user` CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
