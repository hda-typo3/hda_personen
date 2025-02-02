<?php

declare(strict_types=1);

namespace Hda\HdaPersonen\Domain\Repository;

use Hda\HdaPersonen\Domain\Model\Person;
use Hda\HdaPersonen\Domain\Model\Dto\SearchFormDto;
use Hda\HdaPersonen\Domain\Repository\PersonRepository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Connection;

/**
 * @extends Repository<Person>
 */
class PersonRepository extends Repository 
{

   // protected $defaultOrderings = ['name' => QueryInterface::ORDER_ASCENDING];
    

        //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($department);
    
    
    /**
    * Select persons from the individual list of "Persons"
     */
    public function findPersons(
        array $setting,
        $constraints = []
        ): QueryResultInterface
        {
        $sort                   = $setting['sort'];
        $allperson              = explode (',',$setting['allpersons']);
        
    
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setRespectSysLanguage(false);
                
        foreach ($allperson as $person) {
            $constraints[] = $query->equals('uid', $person);
        }

        if ($sort == '1' ){
            $query->setOrderings([
                'name' => QueryInterface::ORDER_ASCENDING,
                'uid' => QueryInterface::ORDER_ASCENDING,
            ]);
        }
        
        if (count($constraints)) {
            $query->matching($query->logicalOr(...array_values($constraints)));
        }
        
        return $query->execute();
    }
    
    
    /**
     * Select persons from the "Employed"
     */
    public function findEmployeds(
        array $setting,
        $constraints = []
        ): QueryResultInterface
        {
            $asc                = $setting['asc'];
            $sort               = $setting['sortby'];
            $employed           = explode (',', $setting['allemployeds']); 
            $startingpoints     = explode (',',$setting['pages']);
            $department         = $setting['alldepartments'];            
            $alldepartment      = explode (',',$setting['alldepartments']);
            
            $query = $this->createQuery();
            $query->getQuerySettings()->setRespectStoragePage(false);
            $query->getQuerySettings()->setRespectSysLanguage(false);
                        
            if ($department != '') {
                $constraints[] = $query->in('pid', $startingpoints);
                $constraints[] = $query->in('employed', $employed);
                $constraints[] = $query->equals('company',$alldepartment);
            } else {
                $constraints[] = $query->in('pid', $startingpoints);
                $constraints[] = $query->in('employed', $employed);
            }
            
            if (count($constraints)) {
                $query->matching($query->logicalAnd(...array_values($constraints)));
            }
            
            
            if ($sort == 'name' ){            
                if ($asc == '1' ){
                    $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING,
                                          'uid' => QueryInterface::ORDER_ASCENDING]);
                } else {
                    $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING,
                                          'uid' => QueryInterface::ORDER_ASCENDING]);
                }
            }
            if ($sort == 'uid' ){
                if ($asc == '1' ){
                    $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING]);
                } else {
                    $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING]);
                }
            }
            if ($sort == 'employed' ){
                if ($asc == '1' ){
                    $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING,
                                         'name' => QueryInterface::ORDER_ASCENDING]);
                } else {
                    $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING,
                                          'name' => QueryInterface::ORDER_ASCENDING]);
                }
            }
            if ($sort == 'company' ){
                if ($asc == '1' ){
                    $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING,
                                          'name' => QueryInterface::ORDER_ASCENDING]);
                } else {
                    $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING,
                                         'name' => QueryInterface::ORDER_ASCENDING]);
                }
            }
            
            return $query->execute();
    }
    
    /**
     * Select persons from the "Roles"
     */
    public function findRoles(
        array $setting,
        $constraints = []
        ): QueryResultInterface
        {
            $startingpoints     = explode (',',$setting['pages']);
            $role 		        = $setting['allroles'];
            $department         = $setting['alldepartments'];
            $asc                = $setting['asc'];
            $sort               = $setting['sortby'];
            $alldepartment      = explode (',',$setting['alldepartments']);             
            
            $query = $this->createQuery();
            $query->getQuerySettings()->setRespectStoragePage(false);
            $query->getQuerySettings()->setRespectSysLanguage(false);
                        
            $constraints[] = $query->equals('company', $department);
            $constraints[] = $query->like('roles', '%' . $role . '%');

            if ($sort == 'name' ){
                if ($asc == '1' ){
                    $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING,
                        'uid' => QueryInterface::ORDER_ASCENDING]);
                } else {
                    $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING,
                        'uid' => QueryInterface::ORDER_ASCENDING]);
                }
            }
            if ($sort == 'uid' ){
                if ($asc == '1' ){
                    $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING]);
                } else {
                    $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING]);
                }
            }
            if ($sort == 'employed' ){
                if ($asc == '1' ){
                    $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING,
                        'name' => QueryInterface::ORDER_ASCENDING]);
                } else {
                    $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING,
                        'name' => QueryInterface::ORDER_ASCENDING]);
                }
            }
            if ($sort == 'company' ){
                if ($asc == '1' ){
                    $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING,
                        'name' => QueryInterface::ORDER_ASCENDING]);
                } else {
                    $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING,
                        'name' => QueryInterface::ORDER_ASCENDING]);
                }
            }
            
            if (count($constraints)) {
                $query->matching($query->logicalAnd(...array_values($constraints)));
            }
            return $query->execute();
    }
    
    /**
     * Select persons from the "Departments"
     */
    
    public function findDepartments(
        array $setting,
        $constraints = []
        ): QueryResultInterface
        {
        
        $startingpoints     = explode (',',$setting['pages']);
        $alldepartment      = explode (',',$setting['alldepartments']);
        $asc                = $setting['asc'];
        $sort               = $setting['sortby'];
        
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setRespectSysLanguage(false);
        
        
        $constraints = $this->generateSearchFormConstraints($searchFormDto, $query);
        
        $constraints[] = $query->in('pid', $startingpoints);
        $constraints[] = $query->in('company',$alldepartment);

        if (count($constraints)) {
            $query->matching($query->logicalAnd(...array_values($constraints)));
        }
        
        if ($sort == 'name' ){
            if ($asc == '1' ){
                $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING,
                    'uid' => QueryInterface::ORDER_ASCENDING]);
            } else {
                $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING,
                    'uid' => QueryInterface::ORDER_ASCENDING]);
            }
        }
        if ($sort == 'uid' ){
            if ($asc == '1' ){
                $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING]);
            } else {
                $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING]);
            }
        }
        if ($sort == 'employed' ){
            if ($asc == '1' ){
                $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING,
                    'name' => QueryInterface::ORDER_ASCENDING]);
            } else {
                $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING,
                    'name' => QueryInterface::ORDER_ASCENDING]);
            }
        }
        if ($sort == 'company' ){
            if ($asc == '1' ){
                $query->setOrderings([$sort => QueryInterface::ORDER_ASCENDING,
                    'name' => QueryInterface::ORDER_ASCENDING]);
            } else {
                $query->setOrderings([$sort => QueryInterface::ORDER_DESCENDING,
                    'name' => QueryInterface::ORDER_ASCENDING]);
            }
        }
        return $query->execute();
        
    }
    
    
    /**
     * Select profil of a "Persons"
     */
    public function findProfil(
        array $setting,
        $constraints = []
        ): QueryResultInterface
        {
            $allperson              = explode (',',$setting['allpersons']);
            
            $query = $this->createQuery();
            $query->getQuerySettings()->setRespectStoragePage(false);
            $query->getQuerySettings()->setRespectSysLanguage(false);
            
            foreach ($allperson as $person) {
                $constraints[] = $query->equals('uid', $person);
            }
                        
            if (count($constraints)) {
                $query->matching($query->logicalOr(...array_values($constraints)));
            }
            
            return $query->execute();
    }
    
    

    /**
     * @param array $startingpoint
     * @return mixed
     */
    public function findPersonsWithoutExtbase(int $startingpoint)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
        $result = $queryBuilder
            ->select('*')
            ->from('fe_users')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($startingpoint, \PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('tx_extbase_type', $queryBuilder->createNamedParameter('Tx_Extbase_Domain_Model_FrontendUser', Connection::PARAM_STR)),
                    $queryBuilder->expr()->neq('employed', $queryBuilder->createNamedParameter('', Connection::PARAM_STR))
                )
            )
            ->executeQuery()
            ->fetchAll();
        return $result;
    }
        
        
    /**
     * Searchform
     */
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
    
    
     

     
     
     
     
     
     
     
     

     

}