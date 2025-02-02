<?php

defined('TYPO3') || die();

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(
    static function (): void {
        ExtensionUtility::registerPlugin(
            'HdaPersonen',
            'Index',
            'Person-Plugin',
            'EXT:hda_personen/Resources/Public/Icons/Extension.svg'
        );
        ExtensionUtility::registerPlugin(
            'HdaPersonen',
            'Search',
            'Person-SearchPlugin',
            'EXT:hda_personen/Resources/Public/Icons/ExtensionSearch.svg'
        );
        ExtensionUtility::registerPlugin(
            'HdaPersonen',
            'Profil',
            'Person-ProfilPlugin',
            'EXT:hda_personen/Resources/Public/Icons/ExtensionProfil.svg'
        );   
     
   // $GLOBALS['TCA']['tt_content']['types']['list']['previewRenderer']['hdapersonen_index'] = \Hda\HdaPersonen\FormEngine\HdaHdapersonenPreviewRenderer::class;
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hdapersonen_index'] = 'select_key,pages,recursive';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hdapersonen_index'] = 'pi_flexform';    
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('hdapersonen_index','FILE:EXT:hda_personen/Configuration/FlexForms/Flexform.xml');

    
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hdapersonen_search'] = 'select_key,pages,recursive';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hdapersonen_search'] = 'select_key,pages,recursive';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hdapersonen_search'] = 'pi_flexform';    
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('hdapersonen_search','FILE:EXT:hda_personen/Configuration/FlexForms/FlexformSearch.xml');
    
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hdapersonen_profil'] = 'select_key,pages,recursive';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['hdapersonen_profil'] = 'select_key,pages,recursive';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['hdapersonen_profil'] = 'pi_flexform';    
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('hdapersonen_profil','FILE:EXT:hda_personen/Configuration/FlexForms/FlexformProfil.xml');
    
    }
);
