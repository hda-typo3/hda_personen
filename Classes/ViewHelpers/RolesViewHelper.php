<?php

namespace Hda\HdaPersonen\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3\CMS\Core\Utility\DebugUtility;


class RolesViewHelper extends AbstractViewHelper {
    
    use CompileWithRenderStatic;
    
    public function initializeArguments()
    {
        $this->registerArgument('salutation', 'string', '', true);
        $this->registerArgument('roles', 'mixed', '', true);
    }
    
    /**
     * 
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string|unknown
     */
    
    
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
        ) {
            $basisXMLstring = file_get_contents('typo3conf/ext/hda_personen/rollen.xml');
            $basisXML = simplexml_load_string($basisXMLstring);
            $json = json_encode($basisXML);
            $roles = json_decode($json, TRUE);
            
            $keyArray = explode(',', $arguments['roles']);
            
 			// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($keyArray);
 			// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($roles);
 			
	        foreach ($roles['item'] as $item) {
	 			foreach ($keyArray as $singlekey){
	 				if ($item['@attributes']['id'] == $singlekey) {
						$role = $item['description']['0'];
						
						if ($arguments['salutation']== 'Herr') {
                        $role = str_replace('(in)','',$role);
                        $role = str_replace('(r)','r',$role);
	                    }
	                    else {
	                        $role = str_replace('(in)','in',$role);
	                        $role = str_replace('(r)','',$role);
	                    }
	
	                 	$result[] = $role;
						$output = '<li>' . implode( '</li><li>', $result) . '</li>';
					}
				}     
	        }

          return $output;
    }
}
