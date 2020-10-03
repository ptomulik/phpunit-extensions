<?php declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Constraint;

use PHPFox\PHPUnit\Properties\IdentityComparator;

/**
 * @covers \PHPFox\PHPUnit\Constraint\ClassPropertiesIdenticalTo
 * @covers \PHPFox\PHPUnit\Constraint\PropertiesConstraintTestCase
 * @covers \PHPFox\PHPUnit\Constraint\ProvClassPropertiesTrait
 * @covers \PHPFox\PHPUnit\Properties\AbstractConstraint
 *
 * @internal
 */
final class ClassPropertiesIdenticalToTest extends PropertiesConstraintTestCase
{
    use ProvClassPropertiesTrait;

    public static function subject(): string
    {
        return 'a class';
    }

    public static function adjective(): string
    {
        return 'identical to';
    }

    public static function constraintClass(): string
    {
        return ClassPropertiesIdenticalTo::class;
    }

    public static function comparatorClass(): string
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
        parent::examinePropertiesMatchSucceeds($expect, $actual);
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     * @dataProvider provClassPropertiesNotEqualToNonClass
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassPropertiesIdenticalToFails(array $expect, $actual, string $string): void
    {
        parent::examinePropertiesMatchFails($expect, $actual, $string);
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     * @dataProvider provClassPropertiesNotEqualToNonClass
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     *
     * @param mixed $actual
     */
    public function testNotClassPropertiesIdenticalToSucceeds(array $expect, $actual): void
    {
        parent::examineNotPropertiesMatchSucceeds($expect, $actual);
    }

    /**
     * @dataProvider provClassPropertiesIdenticalTo
     *
     * @param mixed $actual
     */
    public function testNotClassPropertiesIdenticalToFails(array $expect, $actual, string $string): void
    {
        parent::examineNotPropertiesMatchFails($expect, $actual, $string);
    }
}

// vim: syntax=php sw=4 ts=4 et:
