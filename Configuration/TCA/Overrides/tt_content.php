<?php
defined('TYPO3_MODE') or die();

/***************
 * Plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'HdaPersonen',
    'Person',
    'Personen-Plugin'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hdapersonen_person'] = 'layout,recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hdapersonen_person'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('hdapersonen_person','FILE:EXT:hda_personen/Configuration/FlexForms/flexform.xml');
