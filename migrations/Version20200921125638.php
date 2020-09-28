<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200921125638 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE manufacturer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD manufacture_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEB4842B7 FOREIGN KEY (manufacture_id) REFERENCES manufacturer (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADEB4842B7 ON product (manufacture_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADEB4842B7');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP INDEX IDX_D34A04ADEB4842B7 ON product');
        $this->addSql('ALTER TABLE product DROP manufacture_id');
    }
}
