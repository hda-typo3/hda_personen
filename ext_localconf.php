<?php
defined('TYPO3_MODE') || defined('TYPO3') || die('Access denied.');

use Hda\HdaPersonen\Controller\PersonController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;


call_user_func(static function () {
    
    // Update flexforms
  //  $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][\TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools::class]['flexParsing'][] = \Hda\HdaPersonen\Hooks\FlexFormHook::class;
    
    ExtensionUtility::configurePlugin(
        'HdaPersonen',
        'Index',
        [
            PersonController::class => 'index',
        ],
        // non-cacheable actions
        [
            PersonController::class => 'index',
        ]
        );
    
    ExtensionUtility::configurePlugin(
        'HdaPersonen',
        'Search',
        [
            PersonController::class => 'search,show',
        ],
        // non-cacheable actions
        [
            PersonController::class => 'search,show',
        ]
        );
    
    ExtensionUtility::configurePlugin(
        'HdaPersonen',
        'Profil',
        [
            PersonController::class => 'profil',
        ],
        // non-cacheable actions
        [
            PersonController::class => 'profil',
        ]
        );

     ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:hda_personen/Configuration/TypoScript/Mapping.typoscript'");
     ExtensionManagementUtility::addPageTSConfig("@import 'EXT:hda_personen/Configuration/TsConfig/Wizard.tsconfig'");
     ExtensionManagementUtility::addPageTSConfig("@import 'EXT:hda_personen/Configuration/TsConfig/Templates.tsconfig'");
    
	
});
