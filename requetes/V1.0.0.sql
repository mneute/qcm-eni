CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, test_id INT DEFAULT NULL, duree_validite DATETIME NOT NULL, temps_ecoule TIME DEFAULT NULL, etat TINYINT(1) NOT NULL, resultat_obtenu INT DEFAULT NULL, INDEX IDX_5E90F6D6FB88E14F (utilisateur_id), INDEX IDX_5E90F6D61E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, theme_id INT DEFAULT NULL, enonce VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, INDEX IDX_B6F7494E59027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE question_tirage (id INT AUTO_INCREMENT NOT NULL, inscription_id INT NOT NULL, question_id INT NOT NULL, est_marquee TINYINT(1) NOT NULL, INDEX IDX_2D4975F75DAC5993 (inscription_id), INDEX IDX_2D4975F71E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE reponse_donnee (id INT AUTO_INCREMENT NOT NULL, question_tirage_id INT NOT NULL, reponse_proposee_id INT NOT NULL, INDEX IDX_5173B9C58B82D4CF (question_tirage_id), INDEX IDX_5173B9C5755AFC17 (reponse_proposee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE reponse_proposee (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, enonce VARCHAR(255) NOT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_FDD966A51E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE section_test (id INT AUTO_INCREMENT NOT NULL, theme_id INT NOT NULL, test_id INT NOT NULL, nbQuestionsATirer INT NOT NULL, INDEX IDX_5DC1920759027487 (theme_id), INDEX IDX_5DC192071E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, duree INT NOT NULL, seuil INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, promotion_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B392FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1D1C63B3A0D96FBF (email_canonical), INDEX IDX_1D1C63B3139DF194 (promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE utilisateur_test (utilisateur_id INT NOT NULL, test_id INT NOT NULL, INDEX IDX_11FE1236FB88E14F (utilisateur_id), INDEX IDX_11FE12361E5D0459 (test_id), PRIMARY KEY(utilisateur_id, test_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id);
ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D61E5D0459 FOREIGN KEY (test_id) REFERENCES test (id);
ALTER TABLE question ADD CONSTRAINT FK_B6F7494E59027487 FOREIGN KEY (theme_id) REFERENCES theme (id);
ALTER TABLE question_tirage ADD CONSTRAINT FK_2D4975F75DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id);
ALTER TABLE question_tirage ADD CONSTRAINT FK_2D4975F71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id);
ALTER TABLE reponse_donnee ADD CONSTRAINT FK_5173B9C58B82D4CF FOREIGN KEY (question_tirage_id) REFERENCES question_tirage (id);
ALTER TABLE reponse_donnee ADD CONSTRAINT FK_5173B9C5755AFC17 FOREIGN KEY (reponse_proposee_id) REFERENCES reponse_proposee (id);
ALTER TABLE reponse_proposee ADD CONSTRAINT FK_FDD966A51E27F6BF FOREIGN KEY (question_id) REFERENCES question (id);
ALTER TABLE section_test ADD CONSTRAINT FK_5DC1920759027487 FOREIGN KEY (theme_id) REFERENCES theme (id);
ALTER TABLE section_test ADD CONSTRAINT FK_5DC192071E5D0459 FOREIGN KEY (test_id) REFERENCES test (id);
ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id);
ALTER TABLE utilisateur_test ADD CONSTRAINT FK_11FE1236FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id);
ALTER TABLE utilisateur_test ADD CONSTRAINT FK_11FE12361E5D0459 FOREIGN KEY (test_id) REFERENCES test (id);