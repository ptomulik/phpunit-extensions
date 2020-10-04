<?php declare(strict_types=1);

/*
 * This file is part of php-tailors/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPTailors\PHPUnit;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

//if (!function_exists('PHPTailors\\PHPUnit\\testInvalidReturnValueExceptionFromExpectedAndActual')) {
//    function testInvalidReturnValueExceptionFromExpectedAndActual(
//        int $argument,
//        string $expected,
//        string $actual
//    ): InvalidReturnValueException {
//        $message = sprintf(
//            'Argument #%d of %s() must be %s, %s given.',
//            $argument,
//            __FUNCTION__,
//            $expected,
//            $actual
//        );
//
//        $exception = InvalidReturnValueException::fromExpectedAndActual($argument, $expected, $actual);
//        Assert::assertSame($message, $exception->getMessage());
//
//        return InvalidReturnValueException::fromExpectedAndActual($argument, $expected, $actual, 2);
//    }
//}

/**
 * @small
 * @covers \PHPTailors\PHPUnit\InvalidReturnValueException
 *
 * @internal This class is not covered by the backward compatibility promise
 * @psalm-internal PHPTailors\PHPUnit
 */
final class InvalidReturnValueExceptionTest extends TestCase
{
    public static function provFromExpectedAndActual(): array
    {
        return [
            'InvalidReturnValueExceptionTest.php:'.__LINE__ => [
                'a string', 'integer',
            ],
        ];
    }

    /**
     * @dataProvider provFromExpectedAndActual
     */
    public function testFromExpectedAndActual(string $expected, string $actual): void
    {
        $message = sprintf('Return value of %s() must be %s, %s returned', 'foo', $expected, $actual);

        $exception = InvalidReturnValueException::fromExpectedAndActual('foo', $expected, $actual);
        self::assertSame($message, $exception->getMessage());
    }

    public static function provFromExpectedTypeAndActualValue(): array
    {
        return [
            'InvalidReturnValueExceptionTest.php:'.__LINE__ => [
                'string', 123,
            ],
            'InvalidReturnValueExceptionTest.php:'.__LINE__ => [
                'string', null,
            ],
            'InvalidReturnValueExceptionTest.php:'.__LINE__ => [
                'string', new \stdClass(),
            ],
        ];
    }

    /**
     * @dataProvider provFromExpectedTypeAndActualValue
     *
     * @param mixed $actual
     */
    public function testFromExpectedTypeAndActualValue(string $expected, $actual): void
    {
        $actualType = is_object($actual) ? 'object' : gettype($actual);
        $message = sprintf('Return value of %s() must be of the type %s, %s returned', 'foo', $expected, $actualType);

        $exception = InvalidReturnValueException::fromExpectedTypeAndActualValue('foo', $expected, $actual);
        self::assertSame($message, $exception->getMessage());
    }
}

// vim: syntax=php sw=4 ts=4 et:
