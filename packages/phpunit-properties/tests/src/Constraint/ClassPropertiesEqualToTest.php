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
use PHPunit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Constraint\AbstractPropertiesConstraint
 * @covers \PHPFox\PHPUnit\Constraint\ClassPropertiesEqualTo
 * @covers \PHPFox\PHPUnit\Constraint\ProvClassPropertiesTrait
 * @covers \PHPFox\PHPUnit\Constraint\PropertiesConstraintTestTrait
 *
 * @internal
 */
final class ClassPropertiesEqualToTest extends TestCase
{
    use PropertiesConstraintTestTrait;
    use ImplementsInterfaceTrait;
    use ExtendsClassTrait;
    use ProvClassPropertiesTrait;

    // required by PropertiesConstraintTestTrait
    public static function getConstraintClass(): string
    {
        return ClassPropertiesEqualTo::class;
    }

    // required by ProvClassPropertiesTrait
    public static function getComparatorClass(): string
    {
        return EqualityComparator::class;
    }

    /**
     * @dataProvider provClassPropertiesIdenticalTo
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassPropertiesEqualToSucceeds(array $expect, $actual): void
    {
        $constraint = ClassPropertiesEqualTo::fromArray($expect);
        self::assertThat($actual, $constraint);
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     * @dataProvider provClassPropertiesNotEqualToNonClass
     *
     * @param mixed $actual
     */
    public function testClassPropertiesEqualToFails(array $expect, $actual, string $message): void
    {
        $constraint = ClassPropertiesEqualTo::fromArray($expect);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(sprintf('Failed asserting that %s.', $message));

        $constraint->evaluate($actual);
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     * @dataProvider provClassPropertiesNotEqualToNonClass
     *
     * @param mixed $actual
     */
    public function testClassNotPropertiesEqualToSucceeds(array $expect, $actual): void
    {
        $constraint = new LogicalNot(ClassPropertiesEqualTo::fromArray($expect));
        self::assertThat($actual, $constraint);
    }

    /**
     * @dataProvider provClassPropertiesIdenticalTo
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassNotPropertiesEqualToFails(array $expect, $actual, string $message): void
    {
        $constraint = new LogicalNot(ClassPropertiesEqualTo::fromArray($expect));

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(sprintf('Failed asserting that %s.', $message));

        $constraint->evaluate($actual);
    }
}

// vim: syntax=php sw=4 ts=4 et:
