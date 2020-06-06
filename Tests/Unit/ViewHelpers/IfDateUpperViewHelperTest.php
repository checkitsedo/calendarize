<?php

declare(strict_types=1);
/**
 * Check if a date is upper.
 */
namespace Checkitsedo\Calendarize\Tests\Unit\ViewHelpers;

use Checkitsedo\Calendarize\Tests\Unit\AbstractUnitTest;
use Checkitsedo\Calendarize\ViewHelpers\IfDateUpperViewHelper;

/**
 * Check if a date is upper.
 */
class IfDateUpperViewHelperTest extends AbstractUnitTest
{
    /**
     * @test
     */
    public function testValidCheck()
    {
        $viewHelper = new IfDateUpperViewHelper();
        self::assertTrue($viewHelper->render(new \DateTime(), '23.04.2026'));
    }
}
