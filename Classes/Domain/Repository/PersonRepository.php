<?php
declare(strict_types=1);

namespace Hda\HdaPersonen\Domain\Repository;

use Hda\HdaPersonen\Domain\Model\Dto\SearchFormDto;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2024 Hochschule Darmstadt
 *  All rights reserved
 ***************************************************************/

/**
 * The repository for Persons
 */
class PersonRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

    public function initializeObject () 
    {
        /** @var $defaultQuerySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $defaultQuerySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $defaultQuerySettings->setRespectStoragePage(false);
        $defaultQuerySettings->setRespectSysLanguage(false);
    }
    
    /**
     * @param array $startingpoints
     * @return mixed
     */
    public function findPersonen($startingpoints) 
    {
        $query = $this->createQuery();     
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setRespectSysLanguage(false);
        $query = $query->matching(
            $query->logicalAnd(
                $query->equals('pid', $startingpoints),
                $query->logicalNot($query->equals ('employed',''))
            )
        );
        return $query->execute();
    }
    
    private function generateSearchFormConstraints (SearchFormDto $searchFormDto = null, $query) 
    {
        $constraints = [];
        if (!is_null($searchFormDto)) {
            if ($searchFormDto->getSearchWord()) {
                $search = $searchFormDto->getSearchWord();
                $constraints[] = $query->logicalOr(
                    $query->like('company', '%' . $search . '%'),
                    $query->like('name', '%' . $search . '%'),
                    $query->like('employed', '%' . $search . '%'),
                    $query->like('educationalarea', '%' . $search . '%'),
                    $query->like('roles', '%' . $search . '%'),
                );
            }
            
            if ($searchFormDto->getFirstChar()) {
                $constraints[] = $query->logicalAnd(
                    $query->like('lastName', $searchFormDto->getFirstChar() . '%')
                );
            }
        }
        return $constraints;
    }
    
    public function findSearchForm(SearchFormDto $searchFormDto, $startingpoints)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setRespectSysLanguage(false);
        
        $constraints = $this->generateSearchFormConstraints($searchFormDto, $query);
        $constraints[] = $query->equals('pid', $startingpoints);
        
        if (count($constraints)) {
            $query->matching(
                $query->logicalAnd($constraints)
            );
        }
        
        $query->setOrderings(array('name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        
        return $query->execute();
    }
    
    // not used any more
    public function getFirstChars()
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
        $resource = $queryBuilder
            ->addSelectLiteral('LOWER(substr(last_name,1,1)) as firstChar')
            ->groupBy('firstChar')
            ->from('fe_users')
            ->orderBy('firstChar');
        
        $constraints = [
            $queryBuilder->expr()->neq('last_name', $queryBuilder->createNamedParameter('', \PDO::PARAM_STR)),
        ];
        if (!empty($constraints)) {
            $resource->where(...$constraints);
        }
        $chars = array_flip(array_column($resource->execute()->fetchAllAssociative(), 'firstChar'));
        $mapping = ['ö' => 'o', 'ä' => 'a', 'ü' => 'u'];
        foreach ($mapping as $from => $to) {
            if (isset($chars[$from])) {
                if (!isset($chars[$to])) {
                    $chars[$to] = 1;
                }
                unset($chars[$from]);
            }
        }
        
        $chars = array_keys($chars);
        sort($chars);
        return $chars;
    }
    
    
    /**
     * Select persons from the "Individual selection"
     * @param array $settings
     * @param SearchFormDto $searchFormDto
     * @return mixed
     */
    public function findPersons($settings, SearchFormDto $searchFormDto = null)
    {
        $sort = $settings['sort'];
        $allpersons = $settings['allpersons'];
        $allpersonArray = explode (',', $allpersons);
				
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setRespectSysLanguage(false);

        $constraints = $this->generateSearchFormConstraints($searchFormDto, $query);
        $search = [];
        foreach ($allpersonArray as $person) {
            $search[] = $query->equals('uid', $person);
        }
        
        $constraints[] = $query->logicalOr($search);
        
        $query = $query->matching(
            $query->logicalAnd($constraints)
        );
        
        /*
        $typo3DbQueryParser = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
        $queryBuilder = $typo3DbQueryParser->convertQueryToDoctrineQueryBuilder($query);
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryBuilder->getSQL());
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryBuilder->getParameters());
        */
        
        $result = $query->execute();
    
        // sorting with the flag in the flexform
        if ($sort) {
           $query->setOrderings(array('name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        }
        
        return $result;
    }


     /**
     * Select persons from the "Employed"
     * @param array $settings
     * @param SearchFormDto $searchFormDto
     * @return mixed
     */
    public function findEmployeds($settings, SearchFormDto $searchFormDto = null)
    {
         $department   = $settings['alldepartments'];
         $allemployeds = $settings['allemployeds'];
		
		 // build the query
         $startingpoints = explode(',',$settings['pages']);    
         $query = $this->createQuery();
         $query->getQuerySettings()->setRespectStoragePage(false);
         $query->getQuerySettings()->setRespectSysLanguage(false);
         $allemployedsArray = explode (',', $allemployeds);
         
         $constraints = $this->generateSearchFormConstraints($searchFormDto, $query);
         
         if ($department != '') {
             $constraints[] = $query->in('pid', $startingpoints);
             $constraints[] = $query->in('employed', $allemployedsArray);
             $constraints[] = $query->equals('company',$department);
         } else {
             $constraints[] = $query->in('pid', $startingpoints);
             $constraints[] = $query->in('employed', $allemployedsArray);
         }
         
         $query = $query->matching(
             $query->logicalAnd($constraints)
         );
		 
         $result = $query->execute();
         // name sorting
         $query->setOrderings(array('name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
         // is result not empty
         $number = $query->count();

         // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($number);
         
         if ($number != 0){
             return $result;
         }
         return;    
     }
     
     /**
      * Select persons from the "Roles"
      * @param array $settings
      * @param SearchFormDto $searchFormDto
      * @return mixed
      */
     public function findRoles($settings, SearchFormDto $searchFormDto = null)
     {
         
         $role 		= $settings['allroles'];
         $department = $settings['alldepartments'];
         
       //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($department);  
         
         $query = $this->createQuery();
         $query->getQuerySettings()->setRespectStoragePage(false);
         $query->getQuerySettings()->setRespectSysLanguage(false);
         
         $constraints = $this->generateSearchFormConstraints($searchFormDto, $query);
         
         if ($department != '') {
             $constraints[] = $query->equals('company', $department);
             $constraints[] = $query->like('roles', '%' . $role . '%');
             $query = $query->matching(
                 $query->logicalAnd($constraints)
             );
         } else {
             
             $startingpoints = explode(',', $settings['pages']);
             $search = [];
             foreach ($startingpoints as $startingpoint) {
                 $search[] = $query->equals('pid', $startingpoint);
             }
             $constraints[] = $query->like('roles', '%' . $role . '%');
             $constraints[] = $query->logicalOr($search);
         }
         
         $query = $query->matching(
             $query->logicalAnd($constraints)
         );
         
         $result = $query->execute();
         // name sorting
         $query->setOrderings(array('name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
         // is result not empty
         $number = $query->count();
         if ($number != 0) {
             return $result;
         }
         return;
     }
     
     
     /**
      * Select persons from the "Departments"
      * @param array $settings
      * @param SearchFormDto $searchFormDto
      * @return mixed
      */
    
     public function findDepartments($settings, SearchFormDto $searchFormDto = null)
     {
         
         $role 		  = $settings['allroles'];
         $employed    = $settings['allemployeds'];
         $department  = $settings['alldepartments'];;
         
         $query = $this->createQuery();
         $query->getQuerySettings()->setRespectStoragePage(false);
         $query->getQuerySettings()->setRespectSysLanguage(false);
         
         $startingpoints = explode(',', $settings['pages']);
         $search = [];
         foreach ($startingpoints as $startingpoint) {
             $search[] = $query->equals('pid', $startingpoint);
         }
         
         $constraints = $this->generateSearchFormConstraints($searchFormDto, $query);
         $constraints[] = $query->like('company', '%' . $department . '%');
         $constraints[] = $query->logicalOr($search);
                  
         if (($role == '') && ($employed == '')) {
             $query = $query->matching(
                 $query->logicalAnd($constraints)
             );             
         }
         
         $result = $query->execute();
         $query->setOrderings(array('name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
         // is result not empty
         $number = $query->count();
         if ($number != 0){
             return $result;
         }
         return;
     }

}