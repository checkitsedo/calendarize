<?php

/**
 * Helper Utility.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\Utility;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

/**
 * Helper Utility.
 */
class HelperUtility
{
    /**
     * Create a object with the given class name
     * Please use GeneralUtility::makeInstance if you do not need DI.
     *
     * @param string $className
     *
     * @return object
     */
    public static function create($className)
    {
        $arguments = \func_get_args();
        $objManager = new ObjectManager();

        return \call_user_func_array([
            $objManager,
            'get',
        ], $arguments);
    }

    /**
     * Get the query for the given class name oder object.
     *
     * @param string|object $objectName
     *
     * @return \TYPO3\CMS\Extbase\Persistence\QueryInterface
     */
    public static function getQuery($objectName)
    {
        $objectName = \is_object($objectName) ? \get_class($objectName) : $objectName;
        /** @var PersistenceManagerInterface $manager */
        static $manager = null;
        if (null === $manager) {
            $manager = self::create(PersistenceManagerInterface::class);
        }

        return $manager->createQueryForType($objectName);
    }

    /**
     * Get the signal slot dispatcher.
     *
     * @return Dispatcher
     */
    public static function getSignalSlotDispatcher(): Dispatcher
    {
        return self::create(Dispatcher::class);
    }

    /**
     * Create a flash message.
     *
     * @param string $message
     * @param string $title
     * @param int    $mode
     *
     * @throws \TYPO3\CMS\Core\Exception
     */
    public static function createFlashMessage($message, $title = '', $mode = FlashMessage::OK)
    {
        $flashMessage = GeneralUtility::makeInstance(FlashMessage::class, $message, $title, $mode, true);
        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        $messageQueue = $flashMessageService->getMessageQueueByIdentifier();
        $messageQueue->enqueue($flashMessage);
    }

    /**
     * Get the database connection.
     *
     * @param mixed $table
     *
     * @return Connection
     */
    public static function getDatabaseConnection($table)
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($table);
    }

    /**
     * Persist all data.
     */
    public static function persistAll()
    {
        /** @var $persist PersistenceManager */
        $persist = self::create(PersistenceManager::class);
        $persist->persistAll();
    }
}
