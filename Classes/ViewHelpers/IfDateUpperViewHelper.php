<?php

/**
 * Check if a date is upper.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\ViewHelpers;

use Checkitsedo\Calendarize\Utility\DateTimeUtility;

/**
 * Check if a date is upper.
 */
class IfDateUpperViewHelper extends AbstractViewHelper
{
    /**
     * Render the view helper.
     *
     * Note: You have to wrap this view helper in an f:if ViewHelper.
     * This VH just return a boolean evaluation value
     *
     * @param string|\DateTime $base
     * @param \DateTime        $check
     *
     * @return string
     */
    public function render($base, $check)
    {
        $base = DateTimeUtility::normalizeDateTimeSingle($base);
        $check = DateTimeUtility::normalizeDateTimeSingle($check);

        return $base < $check;
    }
}
