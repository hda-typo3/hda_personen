<?php

namespace Hda\HdaPersonen\ViewHelpers;


use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class WebsiteViewHelper extends AbstractViewHelper {
    
    use CompileWithRenderStatic;
    
    public function initializeArguments()
    {
        $this->registerArgument('www', 'string', '', true);
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
             $targets[] = $arguments['www'];
             foreach($targets as $value) {
                if(strpos($value, 'h-da.de') == true) {	
                   return '';  
                 } else {
                    return $value; 
                 }
             }
     }
}
