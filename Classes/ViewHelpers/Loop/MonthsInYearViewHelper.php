<?php

/**
 * Months in year view Helper.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\ViewHelpers\Loop;

/**
 * Months in year view Helper.
 */
class MonthsInYearViewHelper extends AbstractLoopViewHelper
{
    /**
     * Get the items.
     *
     * @param \DateTime $date
     *
     * @return array
     */
    protected function getItems(\DateTime $date)
    {
        $months = [];
        $date->setDate((int)$date->format('Y'), (int)$date->format('n'), 1);
        for ($i = 0; $i < 12; ++$i) {
            $months[$date->format('n')] = [
                'week' => $date->format('n'),
                'date' => clone $date,
                'break3' => $date->format('n') % 3,
                'break4' => $date->format('n') % 4,
            ];
            $date->modify('+1 month');
        }

        return $months;
    }
}
