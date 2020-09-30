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

use PHPFox\PHPUnit\InheritanceAssertionsTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Constraint\AbstractPropertiesComparator
 * @covers \PHPFox\PHPUnit\Constraint\ObjectPropertiesIdenticalTo
 * @covers \PHPFox\PHPUnit\Constraint\PropertiesComparatorTestTrait
 *
 * @internal
 */
final class ObjectPropertiesIdenticalToTest extends TestCase
{
    use PropertiesComparatorTestTrait;
    use InheritanceAssertionsTrait;

    // required by PropertiesComparatorTestTrait
    public function getPropertiesComparatorClass(): string
    {
        return ObjectPropertiesIdenticalTo::class;
    }
}

// vim: syntax=php sw=4 ts=4 et:
