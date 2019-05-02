CREATE TABLE gold_system_history (
  gold_hist_id bigint(11) unsigned NOT NULL auto_increment,
  gold_hist_user_id int(11) unsigned NOT NULL default '0',
  gold_hist_date int(11) unsigned NOT NULL default '0',
  gold_hist_type text,
  gold_hist_amount decimal(14,2) NOT NULL default '0.00',
  gold_hist_who int(11) unsigned NOT NULL default '0',
  gold_hist_comment text,
  gold_hist_plugin varchar(100) default NULL,
  gold_hist_forum_post int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (gold_hist_id),
  KEY gold_hist_userid (gold_hist_user_id),
  KEY gold_hist_who (gold_hist_who)
) ENGINE=InnoDB;
CREATE TABLE gold_system (
  gold_id bigint(11) unsigned NOT NULL default '0',
  gold_balance decimal(14,2) NOT NULL default '0.00',
  gold_spent decimal(14,2)  NOT NULL default '0.00',
  gold_credit decimal(14,2) NOT NULL default '0.00',
  gold_inv text,
  gold_orb text,
  gold_additional text,
  PRIMARY KEY  (gold_id)
) ENGINE=InnoDB;
CREATE TABLE `gold_system_plugins` (
	`gold_plug_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`gold_plug_name` VARCHAR(50) NOT NULL,
	`gold_plug_version` VARCHAR(10) NOT NULL,
	`gold_plug_author` VARCHAR(50) NOT NULL,
	`gold_plug_path` VARCHAR(100) NOT NULL,
	`gold_plug_installed` TINYINT(3) UNSIGNED NOT NULL,
	`gold_plug_active` TINYINT(3) UNSIGNED NOT NULL,
	`gold_plug_depends` VARCHAR(200) NOT NULL,
	`gold_plug_lastupdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`gold_plug_id`),
	UNIQUE INDEX `gold_plug_name` (`gold_plug_name`)
)ENGINE=InnoDB;

