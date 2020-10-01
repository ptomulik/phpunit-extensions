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

//    public function testNotClassPropertiesEqualToSucceeds(array $expect, string $class): void
//    {
//    }
}

// vim: syntax=php sw=4 ts=4 et:
