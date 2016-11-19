DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`(
	`id` TINYINT(10) UNSIGNED AUTO_INCREMENT KEY,
    `username` VARCHAR(20) NOT NULL UNIQUE,
    `password` VARCHAR(20) NOT NULL
);

INSERT INTO admin (username,password) VALUES ('sky','1234');
ALTER TABLE admin MODIFY username VARCHAR(20) CHARACTER SET gbk;

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`(
	`id` TINYINT(10) UNSIGNED AUTO_INCREMENT KEY,
	`title` VARCHAR(20) NOT NULL,
	`auth` VARCHAR(20) NOT NULL,
	`description` text,
	`time` INT UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 
ALTER TABLE news ADD `from` TEXT NOT NULL;
ALTER TABLE news MODIFY title VARCHAR(20) CHARACTER SET gbk;
ALTER TABLE news MODIFY auth VARCHAR(20) CHARACTER SET gbk;
ALTER TABLE news MODIFY description text CHARACTER SET gbk;
ALTER TABLE news MODIFY `from` text CHARACTER SET gbk;


alter table news default character set utf8;

alter table news CHANGE title title varchar(20) NOT NULL character utf8;