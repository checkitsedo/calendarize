<?php

/**
 * Index traversing.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\ViewHelpers;

use Checkitsedo\Calendarize\Domain\Model\Index;
use Checkitsedo\Calendarize\Domain\Repository\IndexRepository;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Index traversing.
 *
 * == Examples ==
 *
 * <code title="Traversing thru future and past occurings of the event">
 * {namespace c=Checkitsedo\Calendarize\ViewHelpers}
 * <f:for each="{c:indexTraversing(index:'{index}', future: 1, past: 0, limit: 10, sort: 'ASC', useIndexTime: 1)}" as="futureEvent">
 *  <f:debug>{futureEvent}</f:debug>
 * </f:for>
 * </code>
 */
class IndexTraversingViewHelper extends AbstractViewHelper
{
    /**
     * Init arguments.
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('index', Index::class, '', true);
        $this->registerArgument('future', 'bool', '', false, true);
        $this->registerArgument('past', 'bool', '', false, false);
        $this->registerArgument('limit', 'int', '', false, 100);
        $this->registerArgument('sort', 'string', '', false, QueryInterface::ORDER_ASCENDING);
        $this->registerArgument('useIndexTime', 'string', '', false, '');
    }

    /**
     * Render method.
     *
     * @return array
     */
    public function render()
    {
        $objectManager = new ObjectManager();
        $indexRepository = $objectManager->get(IndexRepository::class);

        return $indexRepository->findByTraversing(
            $this->arguments['index'],
            $this->arguments['future'],
            $this->arguments['past'],
            (int)$this->arguments['limit'],
            $this->arguments['sort'],
            $this->arguments['useIndexTime']
        );
    }
}
