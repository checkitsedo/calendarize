<?php

/**
 * Booking interface.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\Features;

/**
 * Booking interface.
 */
interface BookingInterface
{
    /**
     * Is the given event is bookable.
     *
     * @return bool
     */
    public function isBookable(): bool;
}
