<?php

/**
 * PageTitleViewHelper.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\ViewHelpers\Backend;

use Checkitsedo\Calendarize\ViewHelpers\AbstractViewHelper;
use TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * PageTitleViewHelper.
 */
class PageTitleViewHelper extends AbstractViewHelper
{
    /**
     * Init arguments.
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('uid', 'int', 'Page UID', true);
    }

    /**
     * Render.
     *
     * @return string
     */
    public function render(): string
    {
        $uid = (int)$this->arguments['uid'];
        $record = BackendUtility::getRecord('pages', $uid);

        return (string)$record['title'];
    }
}
