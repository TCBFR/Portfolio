 CREATE DATABASE equipe_db;

USE equipe_db;

CREATE TABLE specialty (
    idspe INT PRIMARY KEY,
    specialty_name VARCHAR(100) NOT NULL
);
CREATE TABLE user (
    iduser INT AUTO_INCREMENT PRIMARY KEY,
    emailuser VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    idspe INT NOT NULL,
    role VARCHAR(50) DEFAULT 'member',
    password_reset BOOLEAN DEFAULT FALSE
);

CREATE TABLE member (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstnamemb VARCHAR(50) NOT NULL,
    lastnamemb VARCHAR(50) NOT NULL,
    descriptionmb TEXT,
    email VARCHAR(100) NOT NULL UNIQUE,
    idspe INT NOT NULL,
    picturemb VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `role` (
  `idrole` int(11) NOT NULL,
  `librole` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
ALTER TABLE `member`
  ADD PRIMARY KEY (`idmb`),
  ADD KEY `fk_id_spe` (`idspe`);

ALTER TABLE `role`
  ADD PRIMARY KEY (`idrole`);


-- ALTER TABLE `specialty`
--   ADD PRIMARY KEY (`idspe`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `fk_id_specialty` (`idspe`);


ALTER TABLE `member`
  MODIFY `idmb` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `role`
  MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT;


-- ALTER TABLE `specialty`
--   MODIFY `idspe` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `member`
  ADD CONSTRAINT `fk_id_spe` FOREIGN KEY (`idspe`) REFERENCES `specialty` (`idspe`);


ALTER TABLE `user`
  ADD CONSTRAINT `fk_id_specialty` FOREIGN KEY (`idspe`) REFERENCES `specialty` (`idspe`);
COMMIT;

ALTER TABLE contact MODIFY COLUMN specialiste VARCHAR(255) NULL;

INSERT INTO specialty (idspe, specialty_name) 
VALUES 
(3, 'communication'),
(4, 'comptabilité'),
(5, 'informatique');
ALTER TABLE member
ADD CONSTRAINT fk_idspe FOREIGN KEY (idspe) REFERENCES specialty(idspe);

ALTER TABLE user ADD COLUMN role ENUM('admin', 'member') NOT NULL DEFAULT 'member';
INSERT INTO user (emailuser, password, idrole) 
VALUES ('admin@example.com', 'admin123', 1);
ALTER TABLE user ADD COLUMN idrole INT;
ALTER TABLE user ADD CONSTRAINT fk_user_role FOREIGN KEY (idrole) REFERENCES role(idrole);
ALTER TABLE user ADD COLUMN email_utilisateur VARCHAR(255);
ALTER TABLE user ADD COLUMN message VARCHAR(255);
ALTER TABLE user ADD date_envoi DATETIME;
ALTER TABLE member ADD COLUMN email VARCHAR(255) NOT NULL AFTER idspe;