<?php

declare(strict_types=1);

namespace Hda\HdaPersonen\Domain\Model;


/**
 * Person
 */
class Page extends Person  {

    /**
     * uid
     *
     * @var int
     */
    protected $uid = '';

    /**
     * pid
     *
     * @var int
     */
    protected $pid = '';

    /**
     * navtitle
     *
     * @var string
     */
    protected $navtitle = '';

    /**
     * Returns the navtitle
     *
     * @return string $navtitle
     */
    public function getNavtitle()
    {
        return $this->navtitle;
    }
}
