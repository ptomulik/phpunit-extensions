<?php declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

if (!function_exists('PHPFox\\PHPUnit\\testInvalidArgumentExceptionFromBackTrace')) {
    function testInvalidArgumentExceptionFromBackTrace(
        int $argument,
        string $expected,
        string $provided
    ): InvalidArgumentException {
        $message = sprintf(
            'Argument #%d of %s() must be %s, %s given.',
            $argument,
            __FUNCTION__,
            $expected,
            $provided
        );

        $exception = InvalidArgumentException::fromBackTrace($argument, $expected, $provided);
        Assert::assertSame($message, $exception->getMessage());

        return InvalidArgumentException::fromBackTrace($argument, $expected, $provided, 2);
    }
}

/**
 * @small
 * @covers \PHPFox\PHPUnit\InvalidArgumentException
 */
final class InvalidArgumentExceptionTest extends TestCase
{
    public static function provFromBackTrace(): array
    {
        return [
            'InvalidArgumentExceptionTest.php:'.__LINE__ => [
                1, 'a string', 'an integer',
            ],
        ];
    }

    /**
     * @dataProvider provFromBackTrace
     */
    public function testFromBackTraceFromMethod(int $argument, string $expected, string $provided): void
    {
        $message = sprintf(
            'Argument #%d of %s() must be %s, %s given.',
            $argument,
            __METHOD__,
            $expected,
            $provided
        );

        $exception = InvalidArgumentException::fromBackTrace($argument, $expected, $provided);
        self::assertSame($message, $exception->getMessage());
    }

    /**
     * @dataProvider provFromBackTrace
     */
    public function testFromBackTraceFromFunction(int $argument, string $expected, string $provided): void
    {
        $message = sprintf(
            'Argument #%d of %s() must be %s, %s given.',
            $argument,
            __METHOD__,
            $expected,
            $provided
        );

        $exception = testInvalidArgumentExceptionFromBackTrace($argument, $expected, $provided);
        self::assertSame($message, $exception->getMessage());
    }
}

// vim: syntax=php sw=4 ts=4 et:
