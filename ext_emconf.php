<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "hda_personen"
 *
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'h_da - Personenplugin',
	'description' => '',
	'category' => 'plugin',
	'author' => 'Hochschule Darmstadt',
	'author_email' => 'typo3@h-da.de',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '12.0.01',
	'constraints' => array(
		'depends' => array(
		    't3up' => '12',
		    'ig_ldap_sso_auth' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);
