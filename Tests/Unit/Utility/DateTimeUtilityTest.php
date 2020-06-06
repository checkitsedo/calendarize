<?php

declare(strict_types=1);

/**
 * DateTimeUtilityTest.
 */
namespace Checkitsedo\Calendarize\Tests\Unit\DateTime;

use Checkitsedo\Calendarize\Tests\Unit\AbstractUnitTest;
use Checkitsedo\Calendarize\Utility\DateTimeUtility;

/**
 * DateTimeUtilityTest.
 */
class DateTimeUtilityTest extends AbstractUnitTest
{
    /**
     * @test
     */
    public function testDaySecondsOfDateTime()
    {
        $dateTime = new \DateTime('23.04.1987 04:36:34');
        $expected = 16594;

        self::assertEquals($expected, DateTimeUtility::getDaySecondsOfDateTime($dateTime), 'The seconds of the date do not match!');
    }
}
