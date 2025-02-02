<?php

declare(strict_types=1);

namespace Hda\HdaPersonen\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class PersonalpageViewHelper extends AbstractViewHelper {
    
    use CompileWithRenderStatic;

    public function initializeArguments()
    {
        $this->registerArgument('key', 'string', '', true);
    }
    

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
                $result = $queryBuilder
                    ->select('*')
                    ->from('pages')
                    ->where(
                        $queryBuilder->expr()->eq('nav_title', $queryBuilder->createNamedParameter($emailname, \PDO::PARAM_STR))
                        )
                     ->executeQuery()
                     ->fetchAll();
                                            
                $target = '';
                
                foreach($result as $value) {
                    $target = $value['uid'];
                }
               return $target;
            }
    }
}
