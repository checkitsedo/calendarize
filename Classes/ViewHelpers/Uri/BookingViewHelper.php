<?php

/**
 * Uri to the booking.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\ViewHelpers\Uri;

/**
 * Uri to the booking.
 */
class BookingViewHelper extends \Checkitsedo\Calendarize\ViewHelpers\Link\BookingViewHelper
{
    /**
     * Render the uri to the given booking.
     *
     * @return string
     */
    public function render()
    {
        parent::render();

        return $this->lastHref;
    }
}
