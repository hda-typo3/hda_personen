<?php

declare(strict_types=1);

namespace Hda\HdaPersonen\Domain\Model\Dto;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * This file is part of the "T3md\Measure" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2024 Georg Ringer
 */

/**
 * Hda\HdaPersonen
 */
class SearchFormDto extends AbstractEntity
{

    /** @var string */
    protected $searchWord = '';
    
    /** @var int */
    protected $company= '';
    
    /**
     * @return string
     */
    public function getSearchWord(): string
    {
        return $this->searchWord;
    }

    /**
     * @param string $searchWord
     * @return SearchFormDto
     */
    public function setSearchWord(string $searchWord): SearchFormDto
    {
        $this->searchWord = $searchWord;
        return $this;
    }  
    
    
    
    /**
     * @return int
     */
    public function getCompany(): int
    {
        return $this->company;
    }
    
    /**
     * @param int $company
     * @return SearchFormDto
     */
    public function setCompany(int $company): SearchFormDto
    {
        $this->company = $ccompany;
        return $this;
    }

   
    public function isEmpty(): bool
    {
        return empty($this->searchWord) && empty($this->company);
    }

}
