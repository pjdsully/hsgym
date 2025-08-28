CREATE DATABASE IF NOT EXISTS hsGym2025 CHARACTER SET utf8mb4;
GRANT ALL PRIVILEGES ON hsGym2025.* TO 'hsgym'@'localhost' IDENTIFIED BY 'password';

USE hsGym2025;

DROP TABLE IF EXISTS `participant`;
DROP TABLE IF EXISTS `family`;

CREATE TABLE `family` (
       id INT NOT NULL AUTO_INCREMENT,  /* This is set automatically */
       schoolYear INT,                  /* e.g. 2025 for the 2025-2026 school year */
       fullNames VARCHAR(255),          /* From form */
       address VARCHAR(255),            /* From form */
       cityStateZip VARCHAR(255),       /* From form */
       telephone VARCHAR(40),           /* From form */
       cell VARCHAR(40),                /* From form */
       email VARCHAR(40),               /* From form */
       newToMinistry TINYINT(1),        /* From form */
       yearsParticipated INT,           /* From form */
       parish VARCHAR(255),             /* From form */
       parishCity VARCHAR(255),         /* From form */
       reviewed TINYINT DEFAULT 0,      /* Set to 1 only after reviewing to screen out internet rubbish */
       legit TINYINT DEFAULT 0,         /* Set to 1 only for what looks like legit data, after review */
       accepted TINYINT DEFAULT 0,      /* Set to 1 only if the data is good (otherwise request resubmission) */
       enrolled TINYINT DEFAULT 0,      /* Set to 1 only if family accepted into ministry for this year */
       paid TINYINT DEFAULT 0,          /* Set to 1 only if family has paid */
       paymentMethod VARCHAR(40),       /* Record, e.g. a check number */
       comments TEXT DEFAULT NULL,      /* For Core Team use */
       PRIMARY KEY (id)
);

CREATE TABLE `participant` (
       id INT NOT NULL AUTO_INCREMENT,  /* This is set automatically */
       family INT,                      /* Link to the family table (set automatically upon form submission) */
       fullName VARCHAR(255),           /* From form */
       birthMonth INT,                  /* From form */
       birthYear INT,                   /* From form */
       grade INT,                       /* From form */
       parentConcerns TEXT,             /* From form */
       waiver TINYINT DEFAULT 0,        /* Set to 1 when diocesan waiver received */
       comments TEXT DEFAULT NULL,      /* For Core Team use (Family/comments will be more generally useful) */
       ageGroup TINYINT DEFAULT NULL,   /* 0 = youngest, 1 = middle, 2 = teen */
       PRIMARY KEY (id),
       FOREIGN KEY (family) REFERENCES family(id)
);
