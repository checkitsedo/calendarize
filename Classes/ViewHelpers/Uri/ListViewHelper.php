<?php

/**
 * Uri to the list.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\ViewHelpers\Uri;

/**
 * Uri to the list.
 */
class ListViewHelper extends \Checkitsedo\Calendarize\ViewHelpers\Link\ListViewHelper
{
    /**
     * Render the uri to the given list.
     *
     * @return string
     */
    public function render()
    {
        parent::render();

        return $this->lastHref;
    }
}
