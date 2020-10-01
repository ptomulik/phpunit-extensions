<?php

declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit;

use PHPFox\PHPUnit\Constraint\ObjectPropertiesEqualTo;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\LogicalNot;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 */
trait ObjectPropertiesEqualToTrait
{
    /**
     * Evaluates a \PHPUnit\Framework\Constraint matcher object.
     *
     * @param mixed $value
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    abstract public static function assertThat($value, Constraint $constraint, string $message = ''): void;

    /**
     * Asserts that selected properties of *$object* are identical to *$expected* ones.
     *
     * @param array  $expected
     *                         An array of key => value pairs with property names as keys and
     *                         their expected values as values
     * @param object $object
     *                         An object to be examined
     * @param string $message
     *                         Optional failure message
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \PHPFox\PHPUnit\InvalidArgumentException      when a non-string keys are found in *$expected*
     */
    public static function assertObjectPropertiesEqualTo(
        array $expected,
        object $object,
        string $message = ''
    ): void {
        static::assertThat($object, static::objectPropertiesEqualTo($expected), $message);
    }

    /**
     * Asserts that selected properties of *$object* are not identical to *$expected* ones.
     *
     * @param array  $expected
     *                         An array of key => value pairs with property names as keys and
     *                         their expected values as values
     * @param object $object
     *                         An object to be examined
     * @param string $message
     *                         Optional failure message
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \PHPFox\PHPUnit\InvalidArgumentException      when a non-string keys are found in *$expected*
     */
    public static function assertNotObjectPropertiesEqualTo(
        array $expected,
        object $object,
        string $message = ''
    ): void {
        static::assertThat($object, new LogicalNot(static::objectPropertiesEqualTo($expected)), $message);
    }

    /**
     * Compares selected properties of *$object* with *$expected* ones.
     *
     * @param array $expected
     *                        An array of key => value pairs with expected values of attributes
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \PHPFox\PHPUnit\InvalidArgumentException      when non-string keys are found in *$expected*
     */
    public static function objectPropertiesEqualTo(array $expected): ObjectPropertiesEqualTo
    {
        return ObjectPropertiesEqualTo::fromArray($expected);
    }
}

// vim: syntax=php sw=4 ts=4 et:
