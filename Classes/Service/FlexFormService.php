<?php

declare(strict_types=1);

namespace Hda\HdaPersonen\Service;

use TYPO3\CMS\Backend\Utility\BackendUtility;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

use Hda\HdaPersonen\Domain\Model\Person;
use Hda\HdaPersonen\Domain\Repository\PersonRepository;

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
		$personRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Hda\HdaPersonen\Domain\Repository\PersonRepository::class);
		$storagePoints = $params['row']['settings.pages'];
		$departments[] = '';
		if (count((array)$storagePoints) > 0){
			$startingpoints = $this->getStartingpoints($params);
			if ($startingpoints[0] != '') {
				foreach ($startingpoints as $startingpoint) {
				    foreach ($personRepository->findPersonsWithoutExtbase($startingpoint) as $person) {
				        if (!in_array($person['company'], $departments)) {
						  $departments[] = $person['company'];
				        }
					}
				}
				if (count($departments) > 0) {
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
	    $url = "https:"."//{$_SERVER['HTTP_HOST']}".'/fileadmin/System/rollen.xml';
	    $basisXMLstring = file_get_contents($url);
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
		$personRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Hda\HdaPersonen\Domain\Repository\PersonRepository::class);
		$storagePoints = $params['row']['settings.pages'];
		$employeds[] = '';
		if (count((array)$storagePoints) > 0){
			$startingpoints = $this->getStartingpoints($params);
			if ($startingpoints[0] != '') {
				// $starts = count($startingpoints) - 1;
				
			    foreach ($startingpoints as $startingpoint) {
			        foreach ($personRepository->findPersonsWithoutExtbase($startingpoint) as $person) {
			            if (!in_array($person['employed'], $employeds)) {
			                 $employeds[] = $person['employed'];
			            }
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
	}
	
	
	/**
	 * Function to thow all departments in the flexform with the selected startingpoints
	 * @param $params
	 * @param $pObj
	 *
	 */
	
	public function person(&$params, &$pObj)
	{
	    $personRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Hda\HdaPersonen\Domain\Repository\PersonRepository::class);
	    $storagePoints = $params['row']['settings.pages'];
	    $persons[] = '';
	    if (count((array)$storagePoints) > 0){
	        $startingpoints = $this->getStartingpoints($params);
	        if ($startingpoints[0] != '') {
	            foreach ($startingpoints as $startingpoint) {
	                foreach ($personRepository->findPersonsWithoutExtbase($startingpoint) as $person) {
	                    if (!in_array($person['name'], $persons) && trim($person['name']) != '') {
	                        $persons[$person['uid']] = $person['name'];
	                    }
	                }
	            }
	           // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(count($persons));
	            
	           if (count($persons) > 0) {
	               asort($persons);
	               foreach ($persons as $uid => $name) {
	                   if ($name != ''){
	                       $params['items'][] = [$name, $uid];
	                   }
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
