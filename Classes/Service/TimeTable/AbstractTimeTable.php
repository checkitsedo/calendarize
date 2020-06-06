<?php

/**
 * Abstract time table service.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\Service\TimeTable;

use Checkitsedo\Calendarize\Domain\Model\Configuration;
use Checkitsedo\Calendarize\Domain\Model\ConfigurationGroup;
use Checkitsedo\Calendarize\Service\AbstractService;
use Checkitsedo\Calendarize\Service\TimeTableService;

/**
 * Abstract time table service.
 */
abstract class AbstractTimeTable extends AbstractService
{
    /**
     * Time table service.
     *
     * @var \Checkitsedo\Calendarize\Service\TimeTableService
     */
    protected $timeTableService;

    /**
     * Inject time table service.
     *
     * @param \Checkitsedo\Calendarize\Service\TimeTableService $timeTableService
     */
    public function injectTimeTableService(TimeTableService $timeTableService)
    {
        $this->timeTableService = $timeTableService;
    }

    /**
     * Modify the given times via the configuration.
     *
     * @param array         $times
     * @param Configuration $configuration
     */
    abstract public function handleConfiguration(array &$times, Configuration $configuration);

    /**
     * Build a single time table by group.
     *
     * @param ConfigurationGroup $group
     *
     * @return array
     */
    protected function buildSingleTimeTableByGroup(ConfigurationGroup $group)
    {
        return $this->timeTableService->getTimeTablesByConfigurationIds($group->getConfigurationIds());
    }

    /**
     * Calculate a hash for the key of the given entry.
     * This prevent double entries in the index.
     *
     * @param array $entry
     *
     * @return string
     */
    protected function calculateEntryKey(array $entry)
    {
        // crc32 may be faster but have more collision-potential
        return \hash('md5', \json_encode($entry));
    }
}
