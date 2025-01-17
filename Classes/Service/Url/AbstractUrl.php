<?php

/**
 * AbstractUrl.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\Service\Url;

use Checkitsedo\Calendarize\Domain\Model\Index;
use Checkitsedo\Calendarize\Domain\Repository\IndexRepository;
use Checkitsedo\Calendarize\Features\SpeakingUrlInterface;
use Checkitsedo\Calendarize\Service\AbstractService;
use Checkitsedo\Calendarize\Utility\ConfigurationUtility;
use Checkitsedo\Calendarize\Utility\HelperUtility;
use TYPO3\CMS\Core\Routing\Aspect\PersistedAliasMapper;

/**
 * AbstractUrl.
 */
abstract class AbstractUrl extends AbstractService
{
    /**
     * Convert the given information.
     *
     * @param $param1
     * @param $param2
     */
    abstract public function convert($param1, $param2);

    /**
     * Build the speaking base.
     *
     * @param int $indexUid
     *
     * @return string
     */
    protected function getIndexBase($indexUid): string
    {
        $indexRepository = HelperUtility::create(IndexRepository::class);
        $index = $indexRepository->findByUid((int)$indexUid);
        if (!($index instanceof Index)) {
            return 'idx-' . $indexUid;
        }

        $originalObject = $index->getOriginalObject();
        if (!($originalObject instanceof SpeakingUrlInterface)) {
            return 'idx-' . $indexUid;
        }

        $base = $originalObject->getRealUrlAliasBase();
        if (!(bool)ConfigurationUtility::get('disableDateInSpeakingUrl')) {
            $datePart = $index->isAllDay() ? 'Y-m-d' : 'Y-m-d-' . $GLOBALS['TYPO3_CONF_VARS']['SYS']['hhmm'];
            $dateInfo = $index->getStartDateComplete()
                ->format($datePart);
            $dateInfo = \preg_replace('/[^0-9\-]/', '-', $dateInfo);
            $base .= '-' . $dateInfo;
        }

        if ((bool)ConfigurationUtility::get('addIndexInSpeakingUrl') || \class_exists(PersistedAliasMapper::class)) {
            $base .= '-' . $indexUid;
        }

        return (string)$base;
    }

    /**
     * Prepare base.
     *
     * @param string $base
     *
     * @return string|string[]|null
     */
    protected function prepareBase(string $base): string
    {
        $result = \mb_strtolower($base);

        return \preg_replace('/[^a-z0-9\-]/', '-', $result);
    }
}
