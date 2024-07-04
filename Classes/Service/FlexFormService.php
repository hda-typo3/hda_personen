<?php
namespace Hda\HdaPersonen\Service;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

class FlexFormService
{
    /**
     * Function to thow all departments in the flexform with the selected startingpoints
     * @param $params
     * @param $pObj
     * 
     */
    
    public function department(&$params, &$pObj)
    {
        
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        $personRepository = $this->objectManager->get(\Hda\HdaPersonen\Domain\Repository\PersonRepository::class); 
        $storagePoints = $params['row']['settings.pages'];
        $departments[] = '';

        
        if (count($storagePoints) != '0'){
            
            $startingpoints = $this->getStartingpoints($params);
            
            if ($startingpoints[0] != '') {
                $starts = count($startingpoints) - 1;
                for ($x = 0; $x <= $starts; $x++) {
                    foreach ($personRepository->findPersonen($startingpoints[$x]) as $person) {
                        $departments[] = $person->getCompany();
                    }
                }
                
                if ($departments != '') {
                    $departments = array_unique($departments);
                    asort($departments);
                    
                    foreach ($departments as $department) {
                        if (!(($department == '') || ($department == 'Hochschule Darmstadt'))) {
                            $params['items'][] = array(
                                $department, $department
                            );
                        }
                    }
                }
            }
        } 
    }
    

    /**
     * Function import the roles as an external link (XML)
     * needed for the flexform and the ViewHelper for the replacing
     */
    public function roles(){
        // system("/usr/bin/wget 'https://sd.h-da.de/cgi-bin/getinfo.cgi?what=xml-rollen' --quiet --output-document=/var/www/htdocs/hda8/typo3conf/ext/hda_personen/rollen.xml");  
        $basisXMLstring = file_get_contents('https://h-da.de/typo3conf/ext/hda_personen/rollen.xml');
        $basisXML = simplexml_load_string($basisXMLstring);
        $json = json_encode($basisXML);
        $roles = json_decode($json, TRUE);
        return $roles;
    }
	

    /**
     * Function to display the roles in the flexform
     * @param $params
     * @param $pObj
     */
    public function importRoles (&$paramater, &$pObj) {
        //fetch all
        $basic = $this->roles();
        //Transfer the roles with the keyword and the description as an array
        foreach ($basic['item'] as $item => $row) {
           $id[$item] = $row['@attributes']['id'];
           $description[$item] = $row['description']['0'];
        }
		
		 // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($description);
		 
        //Arrayssorting      
         array_multisort($description, SORT_ASC, $basic['item']);
        
        //Display the roles in the flexform
        foreach ($basic['item'] as $item) {
            $paramater['items'][] = array(
                $item['description']['0'], $item['@attributes']['id']
            );
        }
    }
	

    /**
     * Function to thow all employers in the flexform with the selected startingpoints
     * @param $params
     * @param $pObj
     */
    public function employed(&$params, &$pObj)
    {
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $personRepository = $this->objectManager->get('Hda\\HdaPersonen\\Domain\\Repository\\PersonRepository');
        $storagePoints = $params['row']['settings.pages'];
        $employeds[] = '';
        if (count($storagePoints) != '0'){
            
            $startingpoints = $this->getStartingpoints($params);
            
            
            if ($startingpoints[0] != '') {
                $starts = count($startingpoints) - 1;
                for ($x = 0; $x <= $starts; $x++) {
                    foreach ($personRepository->findPersonen($startingpoints[$x]) as $person) {
                        $employeds[] = $person->getEmployed();
                    }
                }
                if ($employeds) {
                    //Clear all double entries
                    $employeds = array_unique($employeds);
                    asort($employeds);
                }
                
                if ($employeds != '') {
                    foreach ($employeds as $employeds) {
                        $params['items'][] = array(
                            $employeds, $employeds
                        );
                    }
                }
            }  
        }

        // error_reporting (E_ALL ^ E_NOTICE);
    }


    /**
     * Function that finds all persons, who are dispayed in the flexform as an object 
     * @param $params
     * @param $pObj
     */
    public function person(&$params, &$pObj){
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $personRepository = $this->objectManager->get('Hda\\HdaPersonen\\Domain\\Repository\\PersonRepository');
        $storagePoints = $params['row']['settings.pages'];
     
        if (count($storagePoints) != '0'){
            
            $startingpoints = $this->getStartingpoints($params);
                        
            
            if ($startingpoints[0] != '') {
                $starts = count($startingpoints) - 1;
                for ($x = 0; $x <= $starts; $x++) {
                    foreach ($personRepository->findPersonen($startingpoints[$x]) as $person) {
                        $personen[] = array('name' => $person->getName(), 'uid' => $person->getUid());
                    }                           
                }   
                // Error nicht ausgeben wenn $personen leer ist -> leerer Ordner
                error_reporting(0); 
                
                if ($personen != '') {
                    asort($personen);
                    foreach ($personen as $person) {
                        $params['items'][] = array(
                            $person['name'], $person['uid']
                        );
                    }
                } 
            }
        }
    }
    
    /**
     * Function for the Startingpoints from the flexform
     * Initially sets $this->storagePoints
     * @param $params
     * @return array
     */
    
    public function getStartingpoints($params)
    {
        $storagePoints = $params['row']['settings.pages'];
        if (is_array($storagePoints)) {
            foreach ($storagePoints as $storagePoint) {
                $result[] = $storagePoint['uid'];
            }
        } else {
            $result = '';
        }
        return $result;
    }

    
}
