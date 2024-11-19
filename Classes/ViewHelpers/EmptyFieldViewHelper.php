<?php

namespace Hda\HdaPersonen\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class EmptyFieldViewHelper extends AbstractViewHelper {
    
    use CompileWithRenderStatic;
    
    public function initializeArguments()
    {
        $this->registerArgument('key', 'string', '', true, 'NULL');
    }  
    
    /**
     * ViewHelper to strip blanks and empty spaces from the key
     * 
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string|unknown
     *
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) 
    {
        if ($arguments['key'] === NULL){
            return '';
        } else {
            $keyString = $arguments['key'];
            $keyOutput = preg_replace('/[ ]*/i', "", $keyString);
            return $keyOutput;
        }
    }
}
