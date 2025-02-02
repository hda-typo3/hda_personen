<?php

declare(strict_types=1);

namespace Hda\HdaPersonen\Controller;

use Hda\HdaPersonen\Domain\Model\Person;
use Hda\HdaPersonen\Domain\Model\Dto\SearchFormDto;
use Hda\HdaPersonen\Domain\Repository\PersonRepository;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Pagination\SlidingWindowPagination;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\DebugUtility;

class PersonController extends ActionController
{
    protected PersonRepository $personRepository;
    
    public function __construct(
        PersonRepository $personRepository
    ){
         $this->personRepository = $personRepository;
    }
    
    /*
     */
    public function indexAction(): ResponseInterface
    {
                        
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($searchForm);   
        
        
        /* Template */
        $conf = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($conf['view']['templateRootPath']);
        $template = $this->settings['templates'];
        if ($template) {
            $view = $templateRootPath . $template . '.html';
            $this->view->setTemplatePathAndFilename($view);
        }
                
        $isPerson = $this->settings['allpersons'];
        $isEmployed = $this->settings['allemployeds'];
        $isRole = $this->settings['allroles'];
        $isDepartment = $this->settings['alldepartments'];   
                
       // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($isDepartment);       
        
        
        /* settings */
           $setting[] = '';
           $setting['allemployeds']     = $this->settings['allemployeds'];
           $setting['allpersons']       = $this->settings['allpersons'];
           $setting['allroles']         = $this->settings['allroles'];
           $setting['alldepartments']   = $this->settings['alldepartments'];
           $setting['pages']            = $this->settings['pages'];
           $setting                     = $this->settings['sort'];  
           $setting                     = $this->settings['sortby'];             
           
          // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings['sort']);
        
        //get the data from repository
        if ($isPerson != '') {
            $persons = $this->personRepository->findPersons($this->settings);
        } elseif ($isEmployed != '') {
            $persons = $this->personRepository->findEmployeds($this->settings);
        } elseif ($isRole != ''){
           // print_r('nicht leer');
            $persons = $this->personRepository->findRoles($this->settings);
        } elseif ($isDepartment != '') {
           // print_r('nicht leer');
            $persons = $this->personRepository->findDepartments($this->settings);
        } else {
            $persons = '';
        }
        

        /* Pagination */        
        if (isset($this->settings['itemPerPage']) && (int)$this->settings['paginate'] > 0){
            $itemsPerPage = (int)$this->settings['itemPerPage'];
        } else {
            $itemsPerPage = (int)1000;
        }
        if (isset($this->settings['maximumLinks']) && (int)$this->settings['paginate'] > 0){
            $maximumLinks = (int)$this->settings['maximumLinks'];
        } else {
            $maximumLinks = (int)1;
        }
        
        
        if($persons){
            $count = count($persons);
            
            $currentPage = $this->request->hasArgument('currentPageNumber')
            ? (int)$this->request->getArgument('currentPageNumber')
            : 1;
            
            
            $paginator = new QueryResultPaginator(
                $persons,
                $currentPage,
                $itemsPerPage
                );
            
            $pagination = new SlidingWindowPagination(
                $paginator,
                $maximumLinks,
                );
        }

        if($count >= $itemsPerPage){
        
            $this->view->assignMultiple([
                'count' => $count,
                'pagination' => $pagination,
                'paginator' => $paginator,
                'currentPageNumber'  => $currentPage,
            ]);
        } else {
              $this->view->assignMultiple([
                  'paginator' => $paginator,
              ]);              
        }
        
        
        
        return $this->htmlResponse();
    }
    
    /*
     * @IgnoreValidation("SearchFormDto)")
     */
    public function searchAction(): ResponseInterface
    {
        
        return $this->htmlResponse();
    }
    
    
    /*
     */
    public function profilAction(): ResponseInterface
    {
        
        $isPerson = $this->settings['allpersons'];
        
        /* settings */
        $setting[] = '';
        $setting['allpersons']       = $this->settings['allpersons'];
        $setting['pages']            = $this->settings['pages'];
        
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings['sort']);
        
        //get the data from repository
        if ($isPerson != '') {
            $person = $this->personRepository->findProfil($this->settings);
        }
        
        $count = count($person);
               
        $this->view->assignMultiple([
            'count' => $count,
            'person' => $person
        ]);
        
        return $this->htmlResponse();
    }

    /*
     */
    public function showAction(): ResponseInterface
    {
        
        return $this->htmlResponse();
    }
    
}
