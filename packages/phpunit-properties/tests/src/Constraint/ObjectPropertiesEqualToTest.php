<?php declare(strict_types=1);

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

/**
 * @small
 * @covers \PHPFox\PHPUnit\Constraint\ObjectPropertiesEqualTo
 * @covers \PHPFox\PHPUnit\Constraint\PropertiesConstraintTestCase
 * @covers \PHPFox\PHPUnit\Constraint\ProvObjectPropertiesTrait
 * @covers \PHPFox\PHPUnit\Properties\AbstractConstraint
 *
 * @internal
 */
final class ObjectPropertiesEqualToTest extends PropertiesConstraintTestCase
{
    use ImplementsInterfaceTrait;
    use ExtendsClassTrait;
    use ProvObjectPropertiesTrait;

    public static function subject(): string
    {
        return 'an object';
    }

    public static function adjective(): string
    {
        return 'equal to';
    }

    public static function constraintClass(): string
    {
        return ObjectPropertiesEqualTo::class;
    }

    public static function comparatorClass(): string
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
        parent::examinePropertiesMatchSucceeds($expect, $actual);
    }

    /**
     * @dataProvider provObjectPropertiesNotEqualTo
     * @dataProvider provObjectPropertiesNotEqualToNonObject
     *
     * @param mixed $actual
     */
    public function testObjectPropertiesEqualToFails(array $expect, $actual, string $string): void
    {
        parent::examinePropertiesMatchFails($expect, $actual, $string);
    }

    /**
     * @dataProvider provObjectPropertiesNotEqualTo
     * @dataProvider provObjectPropertiesNotEqualToNonObject
     *
     * @param mixed $actual
     */
    public function testNotObjectPropertiesEqualToSucceeds(array $expect, $actual): void
    {
        parent::examineNotPropertiesMatchSucceeds($expect, $actual);
    }

    /**
     * @dataProvider provObjectPropertiesIdenticalTo
     * @dataProvider provObjectPropertiesEqualButNotIdenticalTo
     *
     * @param mixed $actual
     */
    public function testNotObjectPropertiesEqualToFails(array $expect, $actual, string $string): void
    {
        parent::examineNotPropertiesMatchFails($expect, $actual, $string);
    }
}

// vim: syntax=php sw=4 ts=4 et:
