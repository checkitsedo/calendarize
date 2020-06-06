<?php

/**
 * Create the needed database fields.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\Slots;

use Checkitsedo\Calendarize\Register;

/**
 * Create the needed database fields.
 */
class Database
{
    /**
     * Add the smart object SQL string the the signal below.
     *
     * @signalClass \TYPO3\CMS\Install\Service\SqlExpectedSchemaService
     * @signalName tablesDefinitionIsBeingBuilt
     *
     * @param array $sqlString
     *
     * @return array
     */
    public function loadCalendarizeTables(array $sqlString)
    {
        $sqlString[] = $this->getCalendarizeDatabaseString();

        return ['sqlString' => $sqlString];
    }

    /**
     * Add the smart object SQL string the the signal below.
     *
     * @signalClass \TYPO3\CMS\Extensionmanager\Utility\InstallUtility
     * @signalName tablesDefinitionIsBeingBuilt
     *
     * @param array  $sqlString
     * @param string $extensionKey
     *
     * @return array
     */
    public function updateCalendarizeTables(array $sqlString, $extensionKey)
    {
        $sqlString[] = $this->getCalendarizeDatabaseString();

        return [
            'sqlString' => $sqlString,
            'extensionKey' => $extensionKey,
        ];
    }

    /**
     * Get  the calendarize string for the registered tables.
     *
     * @return string
     */
    protected function getCalendarizeDatabaseString()
    {
        $sql = [];
        foreach (Register::getRegister() as $configuration) {
            $sql[] = 'CREATE TABLE ' . $configuration['tableName'] . ' (
			calendarize tinytext
			);';
        }

        return \implode(LF, $sql);
    }
}
