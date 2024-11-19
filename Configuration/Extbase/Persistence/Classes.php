<?php
declare(strict_types = 1);

return [
    \Hda\HdaPersonen\Domain\Model\Person::class => [
        'tableName' => 'fe_users',
        'recordType' => 'Tx_Extbase_Domain_Model_FrontendUser',
        'properties' => [
            'employed' => [
                'fieldName' => 'employed'
            ],
            'roles' => [
                'fieldName' => 'roles'
            ],
            'consultation' => [
                'fieldName' => 'consultation'
            ],
            'profil' => [
                'fieldName' => 'profil'
            ],
            'educationalarea' => [
                'fieldName' => 'educationalarea'
            ],
            'salutation' => [
                'fieldName' => 'salutation'
            ],
            'office' => [
                'fieldName' => 'office'
            ],
            'mobil' => [
                'fieldName' => 'mobil'
            ],
            'orcid' => [
                'fieldName' => 'orcid'
            ],
        ],
    ],
    \Hda\HdaPersonen\Domain\Model\Page::class => [
        'tableName' => 'pages',
        'recordType' => null,
        'properties' => [
            'navtitle' => [
                'fieldName' => 'nav_title'
            ],
            'subtitle' => [
                'fieldName' => 'subtitle'
            ],
        ],
    ],
];