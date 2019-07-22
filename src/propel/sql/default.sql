
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- api_token
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `api_token`;

CREATE TABLE `api_token`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `token` VARCHAR(100) NOT NULL,
    `device_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `device_id` (`device_id`),
    CONSTRAINT `api_token_ibfk_1`
        FOREIGN KEY (`device_id`)
        REFERENCES `devices` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- budget
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `budget`;

CREATE TABLE `budget`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(250),
    `description` TEXT NOT NULL,
    `file` VARCHAR(250) NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- charter
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `charter`;

CREATE TABLE `charter`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(250) NOT NULL,
    `required_document` TEXT NOT NULL,
    `responsible_person` VARCHAR(250) NOT NULL,
    `time_required` VARCHAR(250) NOT NULL,
    `total_fees` DECIMAL(18,2) NOT NULL,
    `complaint_to` VARCHAR(250) NOT NULL,
    `remarks` TEXT NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- decision
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `decision`;

CREATE TABLE `decision`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(250),
    `description` TEXT NOT NULL,
    `file` VARCHAR(250) NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- devices
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `devices`;

CREATE TABLE `devices`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `device_unique_code` VARCHAR(500) NOT NULL,
    `fcm_token` VARCHAR(500) NOT NULL,
    `created_at` DATE NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- employee
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(250) NOT NULL,
    `designation` VARCHAR(250) NOT NULL,
    `mobile_no` VARCHAR(250) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- feedback
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(250) NOT NULL,
    `address` VARCHAR(250) NOT NULL,
    `phone` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `feedback` TEXT NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fos_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fos_group`;

CREATE TABLE `fos_group`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `roles` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fos_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fos_user`;

CREATE TABLE `fos_user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255),
    `username_canonical` VARCHAR(255),
    `email` VARCHAR(255),
    `email_canonical` VARCHAR(255),
    `enabled` TINYINT(1) DEFAULT 0,
    `salt` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `last_login` DATETIME,
    `locked` TINYINT(1) DEFAULT 0,
    `expired` TINYINT(1) DEFAULT 0,
    `expires_at` DATETIME,
    `confirmation_token` VARCHAR(255),
    `password_requested_at` DATETIME,
    `credentials_expired` TINYINT(1) DEFAULT 0,
    `credentials_expire_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `fos_user_U_1` (`username_canonical`),
    UNIQUE INDEX `fos_user_U_2` (`email_canonical`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fos_user_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fos_user_group`;

CREATE TABLE `fos_user_group`
(
    `fos_user_id` INTEGER NOT NULL,
    `fos_group_id` INTEGER NOT NULL,
    PRIMARY KEY (`fos_user_id`,`fos_group_id`),
    INDEX `fos_user_group_FI_2` (`fos_group_id`),
    CONSTRAINT `fos_user_group_FK_1`
        FOREIGN KEY (`fos_user_id`)
        REFERENCES `fos_user` (`id`),
    CONSTRAINT `fos_user_group_FK_2`
        FOREIGN KEY (`fos_group_id`)
        REFERENCES `fos_group` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- gallery
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` TEXT NOT NULL,
    `caption` TEXT NOT NULL,
    `files` TEXT NOT NULL,
    `file_type` VARCHAR(25) NOT NULL,
    `dates` DATE NOT NULL,
    `orgid` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- images
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `gallery_id` INTEGER NOT NULL,
    `image` VARCHAR(250) NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `gallery_id` (`gallery_id`),
    CONSTRAINT `images_ibfk_1`
        FOREIGN KEY (`gallery_id`)
        REFERENCES `gallery` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- introduction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `introduction`;

CREATE TABLE `introduction`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(250) NOT NULL,
    `address` VARCHAR(250) NOT NULL,
    `phone` VARCHAR(50) NOT NULL,
    `fax` VARCHAR(50) NOT NULL,
    `toll_free` VARCHAR(50) NOT NULL,
    `emails` VARCHAR(250) NOT NULL,
    `website` VARCHAR(250) NOT NULL,
    `facebook` VARCHAR(250) NOT NULL,
    `twitter` VARCHAR(250) NOT NULL,
    `description` TEXT NOT NULL,
    `head_officer` VARCHAR(250) NOT NULL,
    `office_phone` VARCHAR(50) NOT NULL,
    `image` VARCHAR(250) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- likes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `post_id` VARCHAR(25) NOT NULL,
    `uzr` VARCHAR(25) NOT NULL,
    `ldl` INTEGER NOT NULL,
    `pdate` DATE NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- maps
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `maps`;

CREATE TABLE `maps`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(250) NOT NULL,
    `lat` VARCHAR(12) NOT NULL,
    `lng` VARCHAR(12) NOT NULL,
    `remarks` VARCHAR(250) NOT NULL,
    `orgid` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- message
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(250),
    `description` TEXT NOT NULL,
    `image` VARCHAR(250) NOT NULL,
    `file` VARCHAR(250) NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- news
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(250),
    `description` TEXT NOT NULL,
    `image` VARCHAR(250) NOT NULL,
    `file` VARCHAR(250) NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- notice
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `notice`;

CREATE TABLE `notice`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(250),
    `description` TEXT NOT NULL,
    `image` VARCHAR(250) NOT NULL,
    `file` VARCHAR(250) NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- officer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `officer`;

CREATE TABLE `officer`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(250) NOT NULL,
    `designation` VARCHAR(250) NOT NULL,
    `mobile_no` VARCHAR(250) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- plan
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `plan`;

CREATE TABLE `plan`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(250),
    `description` TEXT NOT NULL,
    `file` VARCHAR(250) NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- post_comment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `post_comment`;

CREATE TABLE `post_comment`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `post_id` INTEGER NOT NULL,
    `uzr` VARCHAR(50) NOT NULL,
    `pdate` DATE NOT NULL,
    `detail` TEXT NOT NULL,
    `orgid` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- post_files
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `post_files`;

CREATE TABLE `post_files`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `post_id` INTEGER NOT NULL,
    `post_type` VARCHAR(20) NOT NULL,
    `files` TEXT NOT NULL,
    `files_type` VARCHAR(20) NOT NULL,
    `orgid` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- posts
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` TEXT NOT NULL,
    `detail` TEXT NOT NULL,
    `date` DATE NOT NULL,
    `content_type` VARCHAR(100) NOT NULL,
    `content_link` TEXT NOT NULL,
    `post_type` VARCHAR(25) NOT NULL,
    `orgid` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- public_comment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `public_comment`;

CREATE TABLE `public_comment`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `cname` VARCHAR(200) NOT NULL,
    `caddress` VARCHAR(200) NOT NULL,
    `cemail` VARCHAR(200) NOT NULL,
    `cnumber` VARCHAR(50) NOT NULL,
    `files` VARCHAR(50) NOT NULL,
    `csuggest` TEXT NOT NULL,
    `cdate` DATE NOT NULL,
    `content_link` TEXT NOT NULL,
    `orgid` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- public_comment_file
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `public_comment_file`;

CREATE TABLE `public_comment_file`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `post_id` VARCHAR(20) NOT NULL,
    `files` TEXT NOT NULL,
    `files_type` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- staff
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    `address` VARCHAR(200) NOT NULL,
    `contact` VARCHAR(200) NOT NULL,
    `post` VARCHAR(200) NOT NULL,
    `depart` VARCHAR(200) NOT NULL,
    `rank` INTEGER NOT NULL,
    `files` TEXT NOT NULL,
    `post_type` VARCHAR(10) NOT NULL,
    `detail` TEXT NOT NULL,
    `remarks` TEXT NOT NULL,
    `orgid` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tax
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tax`;

CREATE TABLE `tax`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(250),
    `description` TEXT NOT NULL,
    `file` VARCHAR(250) NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
