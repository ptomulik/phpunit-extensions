<?php

/*
 * This file is part of Korowai framework.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

declare(strict_types=1);

namespace PHPFox\PHPUnit\Properties;

use PHPFox\PHPUnit\Properties\AbstractPropertySelector;
use PHPFox\PHPUnit\Properties\ObjectPropertySelector;
use PHPFox\PHPUnit\Properties\PropertySelectorInterface;
use PHPFox\PHPUnit\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Properties\AbstractPropertySelector
 * @covers \PHPFox\PHPUnit\Properties\ObjectPropertySelector
 * @covers \PHPFox\PHPUnit\Properties\ObjectPropertySelectorTestTrait
 *
 * @internal
 */
final class ObjectPropertySelectorTest extends TestCase
{
    use ObjectPropertySelectorTestTrait;

    // required by ObjectPropertySelectorTestTrait
    public function createObjectPropertySelector(): PropertySelectorInterface
    {
        return new ObjectPropertySelector();
    }

    //
    //
    // TESTS
    //
    //

    public function testImplementsPropertySelectorInterface(): void
    {
        $this->assertImplementsInterface(PropertySelectorInterface::class, ObjectPropertySelector::class);
    }

    public function testExtendsAbstractPropertySelector(): void
    {
        $this->assertExtendsClass(AbstractPropertySelector::class, ObjectPropertySelector::class);
    }
}
// vim: syntax=php sw=4 ts=4 et:
