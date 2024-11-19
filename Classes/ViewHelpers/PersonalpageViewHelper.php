<?php

namespace Hda\HdaPersonen\ViewHelpers;


use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class PersonalpageViewHelper extends AbstractViewHelper {
    
    use CompileWithRenderStatic;

    public function initializeArguments()
    {
        $this->registerArgument('key', 'string', '', true);
        // $this->registerArgument('target', 'string', '', false);
    }
    
    
    /**
     * @var \Hda\HdaPersonen\Domain\Repository\PageRepository
     */
    protected $pageRepository;


    /**
     * 
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     */
    
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
        ) {
            if ($arguments['key'] === NULL){
                return '';
            }
            else {
                # find the page with the information from email
                $emailexplode = explode('@',$arguments['key']);
                $emailname = $emailexplode[0];
                $emailname = str_replace('.', ' ', $emailname);
                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');

                $statement = $queryBuilder
                ->select('uid', 'nav_title')
                ->from('pages')
                ->where($queryBuilder->expr()->eq('nav_title', $queryBuilder->createNamedParameter($emailname)))
                ->execute()
                ->fetchAll();
                 $target = '';
                

                    foreach($statement as $value) {
                        $target = $value['uid'];
                    }

                
                return $target;
            }
            
    }
}
