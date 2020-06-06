<?php

/**
 * AbstractBookingRequest.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\Domain\Model\Request;

use Checkitsedo\Calendarize\Domain\Model\AbstractModel;

/**
 * AbstractBookingRequest.
 */
abstract class AbstractBookingRequest extends AbstractModel
{
    /**
     * Index.
     *
     * @var \Checkitsedo\Calendarize\Domain\Model\Index
     */
    protected $index;

    /**
     * Get index.
     *
     * @return \Checkitsedo\Calendarize\Domain\Model\Index
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Set index.
     *
     * @param \Checkitsedo\Calendarize\Domain\Model\Index $index
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }
}
