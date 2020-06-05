<?php

/**
 * Reindex the event models.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\Command;

use Checkitsedo\Calendarize\Service\IndexerService;

/**
 * Reindex the event models.
 */
class ReindexCommandController extends AbstractCommandController
{
    /**
     * Run the reindex process.
     */
    public function runCommand()
    {
        $indexer = $this->objectManager->get(IndexerService::class);
        $indexer->reindexAll();
    }
}
