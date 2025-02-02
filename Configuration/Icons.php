<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [

    'hdapersonen_index' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:hda_personen/Resources/Public/Icons/Extension.svg',
    ],

    'hdapersonen_search' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:hda_personen/Resources/Public/Icons/ExtensionSearch.svg',
    ],

];