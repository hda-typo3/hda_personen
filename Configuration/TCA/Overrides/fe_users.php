<?php

defined('TYPO3') || die('Access denied.');

$GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';

// enable language translations for fe_users:
$GLOBALS['TCA']['fe_users']['ctrl']['languageField'] = 'sys_language_uid';
$GLOBALS['TCA']['fe_users']['ctrl']['transOrigPointerField'] = 'l10n_parent';
$GLOBALS['TCA']['fe_users']['ctrl']['transOrigDiffSourceField'] = 'l10n_diffsource';

// don't show these fields in language overlays
$GLOBALS['TCA']['fe_users']['columns']['username']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['password']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['usergroup']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['lastlogin']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['company']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['title']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['name']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['first_name']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['middle_name']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['last_name']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['address']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['zip']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['city']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['country']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['tx_odsosm_lon']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['tx_odsosm_lat']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['telephone']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['fax']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['email']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['www']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['image']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['TSconfig']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['felogin_redirectPid']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['disable']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['starttime']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['endtime']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['description']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['tx_extbase_type']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['fe_users']['columns']['tx_igldapssoauth_dn']['l10n_mode'] = 'exclude';

$feUsersColumns = [
    'sys_language_uid' => [
        'exclude' => true,
        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
        'config' => [
            'type' => 'language',
        ],
    ],
    'l10n_parent' => [
        'displayCond' => 'FIELD:sys_language_uid:>:0',
        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'default' => 0,
            'items' => [
                ['', 0],
            ],
            'foreign_table' => 'fe_users',
            'foreign_table_where' => 'AND {#fe_users}.{#pid}=###CURRENT_PID### AND {#fe_users}.{#sys_language_uid} IN (-1,0)',
        ],
    ],
    'l10n_diffsource' => [
        'config' => [
            'type' => 'passthrough',
        ],
    ],
    'imageref' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:imageref',
        'l10n_mode' => 'exclude',
        'config' => [
            'type' => 'input',
            'size' => 19,
            'eval' => 'trim'
         ]
    ],
    'mobil' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:mobil',
        'l10n_mode' => 'exclude',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ]
    ],    
    'employed' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:employed',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ]
    ],
    'office' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:office',
        'l10n_mode' => 'exclude',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ]
    ],
    'salutation' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:salutation',
        'l10n_mode' => 'exclude',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ]
    ],
    'roles' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:roles',
        'config' => [
	        'type' => 'text',
	        'cols' => 40,
	        'rows' => 3,
            'eval' => 'trim'
        ]
    ],
    'consultation' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:consultation',
        'config' => [
	        'type' => 'text',
	        'cols' => 40,
	        'rows' => 6
        ]
    ],  
   'profil' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:profil',
        'config' => [
	        'type' => 'text',
	        'cols' => 40,
	        'rows' => 15
        ]
    ],  
    'educationalarea' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:educationalarea',
        'config' => [
	        'type' => 'text',
	        'cols' => 40,
	        'rows' => 3
        ]
    ],
    'orcid' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:orcid',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ]
    ]    
];


$fields 		= 'employed,roles,consultation,profil,educationalarea,imageref,orcid';
$salutation 	= 'salutation';
$office 		= 'office';
$mobil 			= 'mobil';
$language 	    = '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $feUsersColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    '--div--;LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:fe_users.tab, ' . $fields
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $salutation, 
    '', 
    'after:title'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $office, 
    '', 
    'after:address'
);

// add language fields to fe_users in a palette at the end
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $language, 
    '', 
    'after:tx_igldapssoauth_dn'
);

