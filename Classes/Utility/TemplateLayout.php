<?php

namespace Hda\HdaPersonen\Utility;

/**
 * This file is part of the "news" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * TemplateLayout utility class
 */
class TemplateLayout implements SingletonInterface
{
    /**
     * Get available template layouts for a certain page
     *
     * @param int $pageUid
     */
    public function getAvailableTemplateLayouts($pageUid): array
    {
        $templateLayouts = [];

        // Check if the layouts are extended by ext_tables
        if (isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['templateLayouts'])
            && is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['templateLayouts'])
        ) {
            $templateLayouts = $GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['templateLayouts'];
        }

        // Add TsConfig values
        foreach ($this->getTemplateLayoutsFromTsConfig($pageUid) as $templateKey => $title) {
            if (is_string($title) && str_starts_with($title, '--div--')) {
                $optGroupParts = GeneralUtility::trimExplode(',', $title, true, 2);
                $title = $optGroupParts[1];
                $templateKey = $optGroupParts[0];
            }
            $templateLayouts[] = [$title, $templateKey];
        }

        return $templateLayouts;
    }


    /**
     * Get template layouts defined in TsConfig
     *
     * @param $pageUid
     * @return array
     */
    protected function getTemplateLayoutsFromTsConfig($pageUid)
    {
        $templateLayouts = [];
        $pagesTsConfig = BackendUtility::getPagesTSconfig($pageUid);
        if (isset($pagesTsConfig['tx_hdapersonen.']['templateLayouts.']) && is_array($pagesTsConfig['tx_hdapersonen.']['templateLayouts.'])) {
            $templateLayouts = $pagesTsConfig['tx_hdapersonen.']['templateLayouts.'];
        }
        return $templateLayouts;
    }
}
