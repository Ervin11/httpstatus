CREATE TABLE websites (id INT AUTO_INCREMENT NOT NULL, url LONGTEXT NOT NULL, delete_url LONGTEXT NOT NULL, status_url LONGTEXT NOT NULL, history_url LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, code INT NOT NULL, date VARCHAR(255) NOT NULL, INDEX IDX_7B00651CF6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
ALTER TABLE status ADD CONSTRAINT FK_7B00651CF6BD1646 FOREIGN KEY (site_id) REFERENCES websites (id);
