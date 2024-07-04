<?php

defined('TYPO3_MODE') or die();

$GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';

$feUsersColumns = [
    'imageref' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:imageref',
        'config' => [
            'type' => 'input',
            'size' => 19,
            'eval' => 'trim'
         ]
    ],
    'mobil' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:mobil',
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
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ]
    ],
    'salutation' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:salutation',
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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $feUsersColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    '--div--;LLL:EXT:hda_personen/Resources/Private/Language/locallang_backend.xlf:fe_users.tab, ' . $fields
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $salutation, '', 'after:title'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $office, '', 'after:address'
);




