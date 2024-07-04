<?php

namespace Hda\HdaPersonen\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;


class ImageViewHelper extends AbstractViewHelper {

    use CompileWithRenderStatic;
 
   public function initializeArguments()
    {
        $this->registerArgument('key', 'string', '', true);
        $this->registerArgument('name', 'string', '', true);
        $this->registerArgument('settings', 'array', '', true);
    }
     
    /**
     * Viewhelper creates connection to personal image of a person (incl. Encyrption)
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
        
            if ($arguments['key'] === NULL){
                return '';
            }
           
            else {
                $imagepath = $arguments['settings']['imagepath'];
                $encryptionkey1 = $arguments['settings']['encryptionkey1'];
                $encryptionkey2 = $arguments['settings']['encryptionkey2'];
				$name = $arguments['name'];
				// $dummy = $arguments['settings']['dummy'];
                
                # the key contains the userid ($bildPur) and the information, about public/ private state
                $cryptArray = explode (',', $arguments['key']);
                $imageRaw = substr($cryptArray[0],0,-4);
               
                # if the image is public
                
                
                if (isset($cryptArray[1])) {
                    if ($cryptArray[1] == "public"){
                        #set the new encryptimage path
                        $cryptImage = $encryptionkey1.$imageRaw.$encryptionkey2;
                        #set md5 hashtag
                        $image = md5($cryptImage) . ".jpg";
                        #build the imagepath for fluid rendering
                        $image = '<img src="'.$imagepath.$image.'" alt="Portrait: '.$name.'" />';
                        return $image;
                    }
                    $context = GeneralUtility::makeInstance(Context::class);
                    if ($cryptArray[1] == "public" && $context->getPropertyFromAspect('frontend.user', 'isLoggedIn')) {
                        $image =  '<img src="'.$arguments['settings']['dummy'].'" alt="Portrait: '.$name.'" />';
                        return $image;
                    }
                    if ($cryptArray[1] == "hidden"){
                        $image =  '<img src="'.$arguments['settings']['dummy'].'" alt="Portrait: '.$name.'" />';
                        return $image;
                    }

                } else {
                    
                    $dummy =  '<img src="'.$arguments['settings']['dummy'].'" alt="Portrait: '.$name.'" />';
                    return $dummy;
                }

           }
    }
}
