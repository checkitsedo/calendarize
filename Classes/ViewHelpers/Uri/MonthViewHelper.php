<?php

/**
 * Uri to the month.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\ViewHelpers\Uri;

/**
 * Uri to the month.
 */
class MonthViewHelper extends \Checkitsedo\Calendarize\ViewHelpers\Link\MonthViewHelper
{
    /**
     * Render the uri to the given month.
     *
     * @return string
     */
    public function render()
    {
        parent::render();

        return $this->lastHref;
    }
}
