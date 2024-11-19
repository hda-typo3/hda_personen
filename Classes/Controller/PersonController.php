<?php

namespace Hda\HdaPersonen\Controller;

use Hda\HdaPersonen\Domain\Model\Dto\SearchFormDto;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use \GeorgRinger\NumberedPagination\NumberedPagination;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * PersonController
 */
class PersonController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
    
    /**
     * personRepository
     *
     * @var \Hda\HdaPersonen\Domain\Repository\PersonRepository
     */
    protected $personRepository;

    /**
     * @var \Hda\HdaPersonen\Domain\Repository\PageRepository
     */
    protected $pageRepository;
    
    /**
     * @param \Hda\HdaPersonen\Domain\Repository\PersonRepository $personRepository
     */
    public function injectPersonenRepository(\Hda\HdaPersonen\Domain\Repository\PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }
    
    /**
     * @param \Hda\HdaPersonen\Domain\Repository\PageRepository $pageRepository
     */
    public function injectPageRepository(\Hda\HdaPersonen\Domain\Repository\PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }
 
    /**
     * action index
     *
     * @return string|object|null|void
     */
    public function indexAction(SearchFormDto $searchForm = null)
    {
        $searchForm = $searchForm ?? new SearchFormDto();
        
        
       // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($searchForm);

        $conf = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

        // error_reporting (E_ALL ^ E_NOTICE);
        //selection from flexform        
        $startingpoints = $this->settings['pages'];

        if (isset($this->settings['itemPerPage'])){
            $itemsPerPage = $this->settings['itemPerPage'];
        } else {
            $itemsPerPage = (int)1;
        }
        if (isset($this->settings['maximumLinks'])){
            $maximumLinks= $this->settings['maximumLinks'];
        } else {
            $maximumLinks = (int)1;
        }
       
        $currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;

        $isPerson   = '';
        $isEmployed = '';
        $isRole     = '';
        $isDepartment = '';
        
        $isPerson = $this->settings['allpersons'];
        $isEmployed = $this->settings['allemployeds'];
        $isRole = $this->settings['allroles'];        
        $isDepartment = $this->settings['alldepartments'];     
                
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($conf['view']['templateRootPath']);
        $template = $this->settings['templates'];
         if ($template) {
            $view = $templateRootPath . $template . '.html'; 
            $this->view->setTemplatePathAndFilename($view);
        }

        //get the data from repository
        if ($isPerson != '') {
            $allPersons = $this->personRepository->findPersons($this->settings);
            $persons = $this->personRepository->findPersons($this->settings, $searchForm);
        } elseif ($isEmployed != '') {
            $allPersons = $this->personRepository->findEmployeds($this->settings);
            $persons = $this->personRepository->findEmployeds($this->settings, $searchForm);
        } elseif ($isRole != ''){
            $allPersons = $this->personRepository->findRoles($this->settings);
            $persons = $this->personRepository->findRoles($this->settings, $searchForm);
        } elseif ($isDepartment != '') {
            $allPersons = $this->personRepository->findDepartments($this->settings);
            $persons = $this->personRepository->findDepartments($this->settings, $searchForm);
        } else {
            $persons = '';
        }
        
        // better take the last name characters from the actually found persons according to plugin settings
        $firstCharacters = [];
        foreach ($allPersons as $person) {
            $char = strtolower(substr(trim($person->getLastName()), 0, 1));
            $char = str_replace(['ö', 'ä', 'ü'], ['o', 'a', 'u'], $char);
            $firstCharacters[$char] = $char;
        }
        
        /*
        if ($searchForm->isEmpty()) {
            $persons = $persons;
        } else {
            $persons = $this->personRepository->findSearchForm($searchForm, $startingpoints);
            // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($persons);
        }
        */
        if ($persons != ''){
         $count = count($persons);
        }
        $currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;
        
        if ($persons != ''){
            $paginator = new \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator($persons, $currentPage, $itemsPerPage);
            $pagination = new \GeorgRinger\NumberedPagination\NumberedPagination($paginator, $maximumLinks);
            $this->view->assign('pagination', [
                'paginator'     => $paginator,
                'pagination'    => $pagination,
            ]);
        }
        
       //  \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(count($persons));
        
        
        $this->view->assignMultiple([
            // 'firstChars'    => $this->personRepository->getFirstChars(),
            'firstChars'    => $firstCharacters,
            'searchForm'    => $searchForm,
            'itemsPerPage'  => $itemsPerPage,
            'person'        => $persons  
            
       ]);

    }
}
