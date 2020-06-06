<?php

declare(strict_types=1);

use Checkitsedo\Calendarize\Register;
use Checkitsedo\Calendarize\Utility\ConfigurationUtility;
use TYPO3\CMS\Core\Category\CategoryRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (!(bool)ConfigurationUtility::get('disableDefaultEvent')) {
    Register::extTables(Register::getDefaultCalendarizeConfiguration());

    $categoryRegistry = GeneralUtility::makeInstance(CategoryRegistry::class);
    $categoryRegistry->add('calendarize', 'tx_calendarize_domain_model_event');
}
