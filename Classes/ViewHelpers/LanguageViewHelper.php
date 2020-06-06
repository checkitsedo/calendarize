<?php

/**
 * LanguageViewHelper.
 */
declare(strict_types=1);

namespace Checkitsedo\Calendarize\ViewHelpers;

use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * LanguageViewHelper.
 */
class LanguageViewHelper extends AbstractViewHelper
{
    /**
     * Get the current language ISO code.
     *
     * @return string
     */
    public function render()
    {
        /** @var TypoScriptFrontendController $tsfe */
        $tsfe = $GLOBALS['TSFE'];
        if (!\is_object($tsfe)) {
            return 'en';
        }

        return \mb_strtolower($tsfe->sys_language_isocode);
    }
}
