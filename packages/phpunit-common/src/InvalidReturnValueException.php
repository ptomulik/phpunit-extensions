<?php declare(strict_types=1);

/*
 * This file is part of php-tailors/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPTailors\PHPUnit;

/**
 * @internal This class is not covered by the backward compatibility promise
 * @psalm-internal PHPTailors\PHPUnit
 */
final class InvalidReturnValueException extends \LogicException implements ExceptionInterface
{
//    public static function fromBackTrace(int $argument, string $expected, string $provided, int $distance = 1): self
//    {
//        $stack = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1 + $distance);
//
//        /**
//         * @psalm-var string|null $caller['class']
//         * @psalm-var callable-string $caller['function']
//         */
//        $caller = $stack[$distance];
//
//        if (null !== ($class = $caller['class'] ?? null)) {
//            $scope = $class.'::';
//        } else {
//            $scope = '';
//        }
//        $function = sprintf('%s%s', $scope, $caller['function']);
//
//        return self::fromFunction($function, $argument, $expected, $provided);
//    }

    /**
     * @param mixed $actualValue Actual value
     *
     * @psalm-template ActualType
     * @psalm-param ActualType $actualValue
     * @param-out ActualType $actualValue
     */
    public static function fromExpectedTypeAndActualValue(string $function, string $expectedType, &$actualValue): self
    {
        $actualType = is_object($actualValue) ? 'object' : gettype($actualValue);

        return self::fromExpectedAndActual($function, sprintf('of the type %s', $expectedType), $actualType);
    }

    public static function fromExpectedAndActual(string $function, string $expected, string $actual): self
    {
        return new self(sprintf('Return value of %s() must be %s, %s returned', $function, $expected, $actual));
    }
}

// vim: syntax=php sw=4 ts=4 et:
