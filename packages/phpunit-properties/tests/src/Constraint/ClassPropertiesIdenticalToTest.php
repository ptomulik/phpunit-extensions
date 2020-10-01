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
use PHPunit\Framework\ExpectationFailedException;
use PHPFox\PHPUnit\Properties\IdentityComparator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Constraint\LogicalNot;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Constraint\AbstractPropertiesConstraint
 * @covers \PHPFox\PHPUnit\Constraint\ClassPropertiesIdenticalTo
 * @covers \PHPFox\PHPUnit\Constraint\PropertiesConstraintTestTrait
 *
 * @internal
 */
final class ClassPropertiesIdenticalToTest extends TestCase
{
    use PropertiesConstraintTestTrait;
    use ImplementsInterfaceTrait;
    use ExtendsClassTrait;
    use ClassPropertiesProvTrait;

    // required by PropertiesConstraintTestTrait
    public static function getConstraintClass(): string
    {
        return ClassPropertiesIdenticalTo::class;
    }

    // required by ClassPropertiesProvTrait
    public static function getComparatorClass(): string
    {
        return IdentityComparator::class;
    }

    /**
     * @dataProvider provClassPropertiesIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassPropertiesIdenticalToSucceeds(array $expect, $actual): void
    {
        $constraint = ClassPropertiesIdenticalTo::fromArray($expect);
        self::assertThat($actual, $constraint);
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     * @dataProvider provClassPropertiesNotEqualToNonClass
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassPropertiesIdenticalToFails(array $expect, $actual, string $message): void
    {
        $constraint = ClassPropertiesIdenticalTo::fromArray($expect);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(sprintf('Failed asserting that %s.', $message));

        $constraint->evaluate($actual);
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     * @dataProvider provClassPropertiesNotEqualToNonClass
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassNotPropertiesIdenticalToSucceeds(array $expect, $actual): void
    {
        $constraint = new LogicalNot(ClassPropertiesIdenticalTo::fromArray($expect));
        self::assertThat($actual, $constraint);
    }

    /**
     * @dataProvider provClassPropertiesIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassNotPropertiesIdenticalToFails(array $expect, $actual, string $message): void
    {
        $constraint = new LogicalNot(ClassPropertiesIdenticalTo::fromArray($expect));

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(sprintf('Failed asserting that %s.', $message));

        $constraint->evaluate($actual);
    }
}

// vim: syntax=php sw=4 ts=4 et:
