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
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Constraint\AbstractPropertiesConstraint
 * @covers \PHPFox\PHPUnit\Constraint\ObjectPropertiesEqualTo
 * @covers \PHPFox\PHPUnit\Constraint\PropertiesComparatorTestTrait
 *
 * @internal
 */
final class ObjectPropertiesEqualToTest extends TestCase
{
    use PropertiesComparatorTestTrait;
    use ImplementsInterfaceTrait;
    use ExtendsClassTrait;

    // required by PropertiesComparatorTestTrait
    public function getPropertiesComparatorClass(): string
    {
        return ObjectPropertiesEqualTo::class;
    }
}

// vim: syntax=php sw=4 ts=4 et:
