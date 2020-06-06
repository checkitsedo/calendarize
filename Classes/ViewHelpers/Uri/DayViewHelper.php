<?php

/**
 * Uri to the day.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\ViewHelpers\Uri;

/**
 * Uri to the day.
 */
class DayViewHelper extends \Checkitsedo\Calendarize\ViewHelpers\Link\DayViewHelper
{
    /**
     * Render the uri to the given day.
     *
     * @return string
     */
    public function render()
    {
        parent::render();

        return $this->lastHref;
    }
}
