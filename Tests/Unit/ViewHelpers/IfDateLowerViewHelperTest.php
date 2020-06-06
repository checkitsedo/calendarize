<?php

declare(strict_types=1);
/**
 * Check if a date is lower.
 */
namespace Checkitsedo\Calendarize\Tests\Unit\ViewHelpers;

use Checkitsedo\Calendarize\Tests\Unit\AbstractUnitTest;
use Checkitsedo\Calendarize\ViewHelpers\IfDateLowerViewHelper;

/**
 * Check if a date is lower.
 */
class IfDateLowerViewHelperTest extends AbstractUnitTest
{
    /**
     * @test
     */
    public function testValidCheck()
    {
        $viewHelper = new IfDateLowerViewHelper();
        self::assertTrue($viewHelper->render(new \DateTime(), '23.04.2004'));
    }
}
