<?php

declare(strict_types=1);

namespace Hda\HdaPersonen\Hooks;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;


class FlexFormHook
{
   /**
   * @param array $dataStructure
   * @param array $identifier
   * @return array
   */
   public function parseDataStructureByIdentifierPostProcess(array $dataStructure, array $identifier): array
   {

     if ($identifier['type'] === 'tca' && $identifier['tableName'] === 'tt_content' && $identifier['dataStructureKey'] === '*,hdapersonen_person') {
         $file = GeneralUtility::getFileAbsFileName('EXT:hda_personen/Configuration/FlexForms/Flexform.xml');
         $content = file_get_contents($file);
         
         if ($content) {
             $dataStructure['sheets']['extraEntry'] = GeneralUtility::xml2array($content);
         }
     }
          
     return $dataStructure;
   } 
   
   
}

 
