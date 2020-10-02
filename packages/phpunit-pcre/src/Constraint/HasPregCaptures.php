<?php

declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Constraint;

use PHPFox\PHPUnit\Preg\CapturesFilter;
use PHPFox\PHPUnit\Preg\CapturesFilterInterface;
use PHPUnit\Framework\Constraint\Constraint;
use SebastianBergmann\Comparator\ComparisonFailure;

/**
 * Constraint that accepts arrays of matches returned from ``preg_match()``
 * having capture groups as specified in the array of expectations.
 *
 * Checks only entries present in the array of expectations. Special values may
 * be used in the expectations:
 *
 * - ``['foo' => false]`` asserts that group ``'foo'`` was not captured,
 * - ``['foo' => true]`` asserts that group ``'foo'`` was captured,
 * - ``['foo' => 'FOO']`` asserts that group ``'foo'`` was captured and it's value equals ``'FOO'``.
 *
 * Boolean expectations (``['foo' => true]`` or ``['foo' => false]``) work
 * properly only with arrays obtained from ``preg_match()`` invoked with
 * ``PREG_UNMATCHED_AS_NULL`` flag.
 *
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 */
final class HasPregCaptures extends Constraint
{
    /**
     * @var array<array-key,bool|string|array{0:string|null,1:int}>
     */
    private $expected;

    /**
     * @var CapturesFilterInterface
     */
    private $filter;

//    private static function validate(array $array): self
//    {
//        foreach ($array as $key => $value) {
//            if (!(is_bool($value) || is_string($value) || (is_array($value) && count($value) > 1
//        }
//    }

    /**
     * Initializes the constraint.
     *
     * @param array $expected an array of expected values
     */
    private function __construct(array $expected, CapturesFilterInterface $filter)
    {
        $this->expected = $expected;
        $this->filter = $filter;
    }

    /**
     * Initializes the constraint.
     *
     * @param array $expected an array of expected values
     */
    public static function create(array $expected, int $flags = PREG_OFFSET_CAPTURE | PREG_UNMATCHED_AS_NULL): self
    {
//        self::validate($expected);

        return new self($expected, new CapturesFilter($flags));
    }

    /**
     * Returns a string representation of the constraint.
     */
    public function toString(): string
    {
        return 'has expected PCRE capture groups';
    }

    /**
     * Evaluates the constraint for parameter $other.
     *
     * If $returnResult is set to false (the default), an exception is thrown
     * in case of a failure. null is returned otherwise.
     *
     * If $returnResult is true, the result of the evaluation is returned as
     * a boolean value instead: true in case of success, false in case of a
     * failure.
     *
     * @param mixed $other
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function evaluate($other, string $description = '', bool $returnResult = false): ?bool
    {
        $success = $this->matches($other);

        if ($returnResult) {
            return $success;
        }

        if (!$success) {
            $f = null;

            if (is_array($other)) {
                [$expected, $actual] = $this->getArraysForComparison($other);
                $f = new ComparisonFailure(
                    $this->expected,
                    $other,
                    $this->exporter()->export($expected),
                    $this->exporter()->export($actual)
                );
            }

            $this->fail($other, $description, $f);
        }

        return null;
    }

    /**
     * Evaluates the constraint for parameter $other. Returns true if the
     * constraint is met, false otherwise.
     *
     * @param mixed $other value or object to evaluate
     */
    protected function matches($other): bool
    {
        if (!is_array($other)) {
            return false;
        }
        [$expect, $actual] = $this->getArraysForComparison($other);

        return $expect === $actual;
    }

    /**
     * Returns the description of the failure.
     *
     * The beginning of failure messages is "Failed asserting that" in most
     * cases. This method should return the second part of that sentence.
     *
     * @param mixed $other evaluated value or object
     */
    protected function failureDescription($other): string
    {
        if (is_object($other)) {
            $what = 'object '.get_class($other);
        } else {
            $what = gettype($other);
        }

        return $what.' '.$this->toString();
    }

    /**
     * @return array[]
     *
     * @psalm-return array{0: array, 1: array}
     */
    private function getArraysForComparison(array $matches): array
    {
        [$expect, $actual] = [[], []];
        $matches = $this->filter->filter($matches);
        foreach ($this->expected as $key => $value) {
            self::updateExpectForComparison($expect, $matches, $key, $value);
            self::updateActualForComparison($actual, $matches, $key);
        }

        return [$expect, $actual];
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @psalm-param array-key $key
     */
    private static function updateExpectForComparison(array &$expect, array $matches, $key, $value): void
    {
        if ($value === self::isCaptured($matches, $key)) {
            if (array_key_exists($key, $matches)) {
                $expect[$key] = $matches[$key];
            }
        } else {
            $expect[$key] = $value;
        }
    }

    /**
     * @param mixed $key
     * @psalm-param array-key $key
     */
    private static function updateActualForComparison(array &$actual, array $matches, $key): void
    {
        if (array_key_exists($key, $matches)) {
            $actual[$key] = $matches[$key];
        }
    }

    private static function isCaptured(array $matches, $key): bool
    {
        if (null === ($val = $matches[$key] ?? null)) {
            return false;
        }
        if (is_array($val)) {
            return !empty($val) && is_string($val[0]);
        }

        return is_string($val);
    }
}

// vim: syntax=php sw=4 ts=4 et:
