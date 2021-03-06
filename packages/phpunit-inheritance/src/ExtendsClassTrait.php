<?php declare(strict_types=1);

/*
 * This file is part of php-tailors/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPTailors\PHPUnit;

use PHPTailors\PHPUnit\Constraint\ExtendsClass;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\LogicalNot;

trait ExtendsClassTrait
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
     * Asserts that *$subject* extends the class *$parent*.
     *
     * @param string $parent  name of the class that is supposed to be extended by *$subject*
     * @param mixed  $subject an object or a class name that is being examined
     * @param string $message custom message
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     */
    public static function assertExtendsClass(string $parent, $subject, string $message = ''): void
    {
        static::assertThat($subject, static::extendsClass($parent), $message);
    }

    /**
     * Asserts that *$subject* does not extend the class *$parent*.
     *
     * @param string $parent  name of the class that is expected to be extended by *$subject*
     * @param mixed  $subject an object or a class name that is being examined
     * @param string $message custom message
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     */
    public static function assertNotExtendsClass(string $parent, $subject, string $message = ''): void
    {
        static::assertThat($subject, new LogicalNot(static::extendsClass($parent)), $message);
    }

    /**
     * Checks objects (an classes) that they extend *$parent* class.
     *
     * @param string $parent name of the class that is expected to be extended
     */
    public static function extendsClass(string $parent): ExtendsClass
    {
        return ExtendsClass::create($parent);
    }
}

// vim: syntax=php sw=4 ts=4 et:
