<?php

/**
 * External service.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\Service\TimeTable;

use Checkitsedo\Calendarize\Domain\Model\Configuration;
use Checkitsedo\Calendarize\Service\IcsReaderService;
use Checkitsedo\Calendarize\Utility\HelperUtility;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * External service.
 */
class ExternalTimeTable extends AbstractTimeTable
{
    /**
     * ICS reader service.
     *
     * @var \Checkitsedo\Calendarize\Service\IcsReaderService
     */
    protected $icsReaderService;

    /**
     * Inject ICS reader service.
     *
     * @param IcsReaderService $icsReaderService
     */
    public function injectIcsReaderService(IcsReaderService $icsReaderService)
    {
        $this->icsReaderService = $icsReaderService;
    }

    /**
     * Modify the given times via the configuration.
     *
     * @param array         $times
     * @param Configuration $configuration
     *
     * @throws \TYPO3\CMS\Core\Exception
     */
    public function handleConfiguration(array &$times, Configuration $configuration)
    {
        $url = $configuration->getExternalIcsUrl();
        if (!GeneralUtility::isValidUrl($url)) {
            HelperUtility::createFlashMessage(
                'Configuration with invalid ICS URL: ' . $url,
                'Index ICS URL',
                FlashMessage::ERROR
            );

            return;
        }

        $externalTimes = $this->icsReaderService->getTimes($url);
        foreach ($externalTimes as $time) {
            $time['pid'] = $configuration->getPid();
            $time['state'] = $configuration->getState();
            $times[$this->calculateEntryKey($time)] = $time;
        }
    }
}
