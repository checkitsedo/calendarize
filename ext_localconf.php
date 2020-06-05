<?php

/**
 * General ext_localconf file.
 */
if (!\defined('TYPO3_MODE')) {
    die('Access denied.');
}

\HDNET\Autoloader\Loader::extLocalconf('Checkitsedo', 'calendarize', \Checkitsedo\Calendarize\Register::getDefaultAutoloader());

if (!(bool) \Checkitsedo\Calendarize\Utility\ConfigurationUtility::get('disableDefaultEvent')) {
    \Checkitsedo\Calendarize\Register::extLocalconf(\Checkitsedo\Calendarize\Register::getDefaultCalendarizeConfiguration());
    /** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
    $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
    $signalSlotDispatcher->connect(
        \Checkitsedo\Calendarize\Command\ImportCommandController::class,
        'importCommand',
        \Checkitsedo\Calendarize\Slots\EventImport::class,
        'importCommand'
    );

    $signalSlotDispatcher->connect(
        \Checkitsedo\Calendarize\Controller\BookingController::class,
        'bookingAction',
        \Checkitsedo\Calendarize\Slots\BookingCountries::class,
        'bookingSlot'
    );
    $signalSlotDispatcher->connect(
        \Checkitsedo\Calendarize\Controller\BookingController::class,
        'sendAction',
        \Checkitsedo\Calendarize\Slots\BookingCountries::class,
        'sendSlot'
    );
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Checkitsedo.calendarize',
    'Calendar',
    [
        'Calendar' => 'list,past,latest,year,quater,month,week,day,detail,search,result,single,shortcut',
        'Booking' => 'booking,send',
    ],
    [
        'Calendar' => 'search,result',
        'Booking' => 'booking,send',
    ]
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\Checkitsedo\Calendarize\Updates\CalMigrationUpdate::class] = \Checkitsedo\Calendarize\Updates\CalMigrationUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\Checkitsedo\Calendarize\Updates\NewIncludeExcludeStructureUpdate::class] = \Checkitsedo\Calendarize\Updates\NewIncludeExcludeStructureUpdate::class;

$GLOBALS['TYPO3_CONF_VARS']['FE']['typolinkBuilder']['record'] = \Checkitsedo\Calendarize\Typolink\DatabaseRecordLinkBuilder::class;


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:calendarize/Configuration/TsConfig/ContentElementWizard.txt">');

$icons = [
    'ext-calendarize-wizard-icon' => 'Resources/Public/Icons/Extension.svg',
];
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
foreach ($icons as $identifier => $path) {
    $iconRegistry->registerIcon(
        $identifier,
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:calendarize/' . $path]
    );
}

if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('google_services')) {
    \FRUIT\GoogleServices\Service\SitemapProvider::addProvider(\Checkitsedo\Calendarize\Service\SitemapProvider\Events::class);
}

if (class_exists(\TYPO3\CMS\Core\Routing\Aspect\PersistedPatternMapper::class)) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['aspects']['EventMapper'] = \Checkitsedo\Calendarize\Routing\Aspect\EventMapper::class;
}
