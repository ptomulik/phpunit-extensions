<?php

/*
 * This file is part of Korowai framework.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

declare(strict_types=1);

namespace PHPFox\PHPUnit\Constraint;

use PHPFox\PHPUnit\Constraint\ObjectPropertiesEqualTo;
use PHPFox\PHPUnit\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Constraint\AbstractPropertiesComparator
 * @covers \PHPFox\PHPUnit\Constraint\ObjectPropertiesEqualTo
 * @covers \PHPFox\PHPUnit\Constraint\PropertiesComparatorTestTrait
 *
 * @internal
 */
final class ObjectPropertiesEqualToTest extends TestCase
{
    use PropertiesComparatorTestTrait;

    // required by PropertiesComparatorTestTrait
    public function getPropertiesComparatorClass(): string
    {
        return ObjectPropertiesEqualTo::class;
    }
}

// vim: syntax=php sw=4 ts=4 et:
