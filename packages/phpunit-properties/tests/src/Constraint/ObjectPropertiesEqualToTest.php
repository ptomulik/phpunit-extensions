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

use PHPFox\PHPUnit\ExtendsClassTrait;
use PHPFox\PHPUnit\ImplementsInterfaceTrait;
use PHPFox\PHPUnit\Properties\EqualityComparator;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Constraint\AbstractPropertiesConstraint
 * @covers \PHPFox\PHPUnit\Constraint\ObjectPropertiesEqualTo
 * @covers \PHPFox\PHPUnit\Constraint\ObjectPropertiesProvTrait
 * @covers \PHPFox\PHPUnit\Constraint\PropertiesConstraintTestTrait
 *
 * @internal
 */
final class ObjectPropertiesEqualToTest extends TestCase
{
    use PropertiesConstraintTestTrait;
    use ImplementsInterfaceTrait;
    use ExtendsClassTrait;
    use ObjectPropertiesProvTrait;

    // required by PropertiesConstraintTestTrait
    public static function getConstraintClass(): string
    {
        return ObjectPropertiesEqualTo::class;
    }

    // required by ObjectPropertiesProvTrait;
    public static function getComparatorClass(): string
    {
        return EqualityComparator::class;
    }

    /**
     * @dataProvider provObjectPropertiesIdenticalTo
     * @dataProvider provObjectPropertiesEqualButNotIdenticalTo
     *
     * @param mixed $actual
     */
    public function testObjectPropertiesEqualToSucceeds(array $expect, $actual): void
    {
        $constraint = ObjectPropertiesEqualTo::fromArray($expect);
        self::assertThat($actual, $constraint);
    }

    /**
     * @dataProvider provObjectPropertiesNotEqualTo
     * @dataProvider provObjectPropertiesNotEqualToNonObject
     *
     * @param mixed $actual
     */
    public function testObjectPropertiesEqualToFails(array $expect, $actual, string $message): void
    {
        $constraint = ObjectPropertiesEqualTo::fromArray($expect);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(sprintf('Failed asserting that %s.', $message));

        $constraint->evaluate($actual);
    }

    /**
     * @dataProvider provObjectPropertiesNotEqualTo
     * @dataProvider provObjectPropertiesNotEqualToNonObject
     *
     * @param mixed $actual
     */
    public function testClassNotPropertiesEqualToSucceeds(array $expect, $actual): void
    {
        $constraint = new LogicalNot(ObjectPropertiesEqualTo::fromArray($expect));
        self::assertThat($actual, $constraint);
    }

    /**
     * @dataProvider provObjectPropertiesIdenticalTo
     * @dataProvider provObjectPropertiesEqualButNotIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassNotPropertiesEqualToFails(array $expect, $actual, string $message): void
    {
        $constraint = new LogicalNot(ObjectPropertiesEqualTo::fromArray($expect));

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(sprintf('Failed asserting that %s.', $message));

        $constraint->evaluate($actual);
    }
}

// vim: syntax=php sw=4 ts=4 et:
