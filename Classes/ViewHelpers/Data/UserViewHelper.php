<?php

namespace Hda\HdaPersonen\ViewHelpers\Data;

use Closure;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class UserViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    public static function renderStatic(
        array $arguments,
        Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $output = $renderChildrenClosure();
        $userRepository = GeneralUtility::makeInstance(FrontendUserRepository::class);
        $context = GeneralUtility::makeInstance(Context::class);
        $userId = $context->getPropertyFromAspect('frontend.user', 'id');
        $user = $userRepository->findByUid($userId);

        $renderingContext->getVariableProvider()->add(
            'loggedInUser',
            $user
        );
        
       return $output;
   }
}