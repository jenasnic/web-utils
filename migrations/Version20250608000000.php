<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250608000000 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE skyrim_effect (id INT AUTO_INCREMENT NOT NULL, name_fr VARCHAR(255) NOT NULL, name_en VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;
            CREATE TABLE skyrim_ingredient (id INT AUTO_INCREMENT NOT NULL, name_fr VARCHAR(255) NOT NULL, name_en VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;
            CREATE TABLE skyrim_ingredient_effect (ingredient_id INT NOT NULL, effect_id INT NOT NULL, INDEX IDX_DE328A80933FE08C (ingredient_id), INDEX IDX_DE328A80F5E9B83B (effect_id), PRIMARY KEY(ingredient_id, effect_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;
            ALTER TABLE skyrim_ingredient_effect ADD CONSTRAINT FK_DE328A80933FE08C FOREIGN KEY (ingredient_id) REFERENCES skyrim_ingredient (id) ON DELETE CASCADE;
            ALTER TABLE skyrim_ingredient_effect ADD CONSTRAINT FK_DE328A80F5E9B83B FOREIGN KEY (effect_id) REFERENCES skyrim_effect (id) ON DELETE CASCADE;
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE skyrim_ingredient_effect DROP FOREIGN KEY FK_DE328A80933FE08C;
            ALTER TABLE skyrim_ingredient_effect DROP FOREIGN KEY FK_DE328A80F5E9B83B;
            DROP TABLE skyrim_effect;
            DROP TABLE skyrim_ingredient_effect;
            DROP TABLE skyrim_ingredient;
            DROP TABLE messenger_messages;
        SQL);
    }
}
