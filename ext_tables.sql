#
# Table structure for table 'fe_users'
#

CREATE TABLE fe_users (
    salutation 		varchar(255) DEFAULT '' NOT NULL,
    roles 			text,
    office 			varchar(255) DEFAULT '' NOT NULL,
    employed 		varchar(255) DEFAULT '' NOT NULL,
    mobil 			varchar(255) DEFAULT '' NOT NULL,
    consultation 	text,
    profil 			text,
 	educationalarea varchar(255) DEFAULT '' NOT NULL,
 	orcid 			varchar(255) DEFAULT '' NOT NULL,
 	imageref 		varchar(255) DEFAULT '' NOT NULL
);

ALTER TABLE `fe_users` CHANGE `www` `www` VARCHAR(255) NOT NULL;
ALTER TABLE `fe_groups` CHANGE `title` `title` VARCHAR(255) NOT NULL;
ALTER TABLE `fe_users` CHANGE `title` `title` VARCHAR(255) NOT NULL; 
