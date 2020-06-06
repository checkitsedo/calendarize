<?php

/**
 * Uri to the quarter.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\ViewHelpers\Uri;

/**
 * Uri to the quarter.
 */
class QuarterViewHelper extends \Checkitsedo\Calendarize\ViewHelpers\Link\QuarterViewHelper
{
    /**
     * Render the uri to the given quarter.
     *
     * @return string
     */
    public function render()
    {
        parent::render();

        return $this->lastHref;
    }
}
