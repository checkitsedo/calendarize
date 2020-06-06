<?php

/**
 * Group service.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\Service\TimeTable;

use Checkitsedo\Calendarize\Domain\Model\Configuration;
use Checkitsedo\Calendarize\Domain\Model\ConfigurationGroup;

/**
 * Group service.
 */
class GroupTimeTable extends AbstractTimeTable
{
    /**
     * Modify the given times via the configuration.
     *
     * @param array         $times
     * @param Configuration $configuration
     */
    public function handleConfiguration(array &$times, Configuration $configuration)
    {
        foreach ($configuration->getGroups() as $group) {
            /** @var ConfigurationGroup $group */
            $times = \array_merge($times, $this->buildSingleTimeTableByGroup($group));
        }
    }
}
