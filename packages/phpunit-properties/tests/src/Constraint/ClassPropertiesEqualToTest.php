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
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Constraint\AbstractPropertiesComparator
 * @covers \PHPFox\PHPUnit\Constraint\ClassPropertiesEqualTo
 * @covers \PHPFox\PHPUnit\Constraint\PropertiesComparatorTestTrait
 *
 * @internal
 */
final class ClassPropertiesEqualToTest extends TestCase
{
    use PropertiesComparatorTestTrait;
    use ImplementsInterfaceTrait;
    use ExtendsClassTrait;
    use ClassPropertiesProvTrait;

    // required by PropertiesComparatorTestTrait
    public function getPropertiesComparatorClass(): string
    {
        return ClassPropertiesEqualTo::class;
    }

    /**
     * @dataProvider provClassPropertiesIdenticalTo
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     */
    public function testClassPropertiesEqualToSucceeds(array $expect, string $class): void
    {
        $constraint = ClassPropertiesEqualTo::fromArray($expect);
        self::assertThat($class, $constraint);
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     */
    public function testClassPropertiesEqualToFails(array $expect, string $class): void
    {
        $constraint = ClassPropertiesEqualTo::fromArray($expect);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(sprintf('%s is a class with properties equal to', $class));

        $constraint->evaluate($class);
    }
}

// vim: syntax=php sw=4 ts=4 et:
