<?php
	if (!defined('IN_CMS')) { exit(); }
	
	$PDO = Record::getConnection();
	$charset_collate = "DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
	$create_table = array();
	$create_table['pollsq'] = "CREATE TABLE IF NOT EXISTS ".TABLE_PREFIX."djg_pollsq (".
									"pollq_id int(10) NOT NULL auto_increment,".
									"pollq_question varchar(200) character set utf8 NOT NULL default '',".
									"pollq_timestamp varchar(20) NOT NULL default '',".
									"pollq_totalvotes int(10) NOT NULL default '0',".
									"pollq_active tinyint(1) NOT NULL default '1',".
									"pollq_expiry varchar(20) NOT NULL default '',".
									"pollq_multiple tinyint(3) NOT NULL default '0',".
									"pollq_totalvoters int(10) NOT NULL default '0',".
									"pollq_date datetime NOT NULL,".
									"PRIMARY KEY (pollq_id)) $charset_collate;";
	$create_table['pollsa'] = "CREATE TABLE IF NOT EXISTS ".TABLE_PREFIX."djg_pollsa (".
									"polla_aid int(10) NOT NULL auto_increment,".
									"polla_qid int(10) NOT NULL default '0',".
									"polla_answers varchar(200) character set utf8 NOT NULL default '',".
									"polla_votes int(10) NOT NULL default '0',".
									"PRIMARY KEY (polla_aid)) $charset_collate;";
	$create_table['pollsip'] = "CREATE TABLE IF NOT EXISTS ".TABLE_PREFIX."djg_pollsip (".
									"pollip_id int(10) NOT NULL auto_increment,".
									"pollip_qid varchar(10) NOT NULL default '',".
									"pollip_aid varchar(10) NOT NULL default '',".
									"pollip_ip varchar(100) NOT NULL default '',".
									"pollip_host VARCHAR(200) NOT NULL default '',".
									"pollip_timestamp varchar(20) NOT NULL default '0000-00-00 00:00:00',".
									"pollip_user tinytext NOT NULL,".
									"pollip_userid int(10) NOT NULL default '0',".
									"PRIMARY KEY (pollip_id),".
									"KEY pollip_ip (pollip_id),".
									"KEY pollip_qid (pollip_qid)".
									") $charset_collate;";
	$stmt = $PDO->prepare($create_table['pollsq']); $stmt->execute();
	$stmt = $PDO->prepare($create_table['pollsa']); $stmt->execute();
	$stmt = $PDO->prepare($create_table['pollsip']); $stmt->execute();

	$settings = array(
		'ver' => '0.0.1',
		'defaultMultiple' => '0',
		'defaultActive' => '1',
		'showTab' => '1',
		'specifyYourVote' => '1',
    'sortResults' => '1',
    'allowSelectAll' => '0',
		'checkCookie' => '0',
		'checkIP' => '0',
    'chartsSize' => '500x220'
	);

	if (Plugin::setAllSettings($settings, 'djg_poll'))
		Flash::setNow('success', __('djg_poll - plugin settings initialized.'));
	else
		Flash::setNow('error', __('djg_poll - unable to store plugin settings!'));	
	exit();