<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200917124057 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
             CREATE TABLE product (
             id INT AUTO_INCREMENT NOT NULL, 
             title VARCHAR(255) NOT NULL, 
             short_description VARCHAR(500) DEFAULT NULL, 
             image VARCHAR(150) NOT NULL, 
             price int NOT NULL, 
             weight int NOT NULL, 
             status INT DEFAULT NULL, 
             created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', 
             updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', 
            PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB 
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE product');
    }
}
