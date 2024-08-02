<?php

defined('TYPO3') || die('Access denied.');

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(static function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'HdaPersonen',
        'Person',
        [
            \Hda\HdaPersonen\Controller\PersonController::class => 'index'
        ],
        // non-cacheable actions
        [
            \Hda\HdaPersonen\Controller\PersonController::class => 'index'
        ]
    );
    
    /* ==  Add TSconfig ============================================ */
    
    ExtensionManagementUtility::addTypoScriptSetup("@import 'EXT:hda_personen/Configuration/TypoScript/Mapping.typoscript'");
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:hda_personen/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig'");
    ExtensionManagementUtility::addPageTSConfig("@import 'EXT:hda_personen/Configuration/TsConfig/Templates.tsconfig'");
   
     /* ==  register icons  ========================================= */
	$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
	
	$iconRegistry->registerIcon(
	    'hda_personen',
	    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
	    ['source' => 'EXT:hda_personen/Resources/Public/Icons/hdaPersonen.svg']
	    );
	
});
