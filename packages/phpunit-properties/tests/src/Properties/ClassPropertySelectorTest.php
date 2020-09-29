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
use PHPFox\PHPUnit\Properties\ClassPropertySelector;
use PHPFox\PHPUnit\Properties\PropertySelectorInterface;
use PHPFox\PHPUnit\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Properties\AbstractPropertySelector
 * @covers \PHPFox\PHPUnit\Properties\ClassPropertySelector
 * @covers \PHPFox\PHPUnit\Properties\ClassPropertySelectorTestTrait
 *
 * @internal
 */
final class ClassPropertySelectorTest extends TestCase
{
    use ClassPropertySelectorTestTrait;

    // required by ClassPropertySelectorTestTrait
    public function createClassPropertySelector(): PropertySelectorInterface
    {
        return new ClassPropertySelector();
    }

    //
    //
    // TESTS
    //
    //

    public function testImplementsPropertySelectorInterface(): void
    {
        $this->assertImplementsInterface(PropertySelectorInterface::class, ClassPropertySelector::class);
    }

    public function testExtendsAbstractPropertySelector(): void
    {
        $this->assertExtendsClass(AbstractPropertySelector::class, ClassPropertySelector::class);
    }
}
// vim: syntax=php sw=4 ts=4 et:
