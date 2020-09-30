<?php

declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Properties;

use PHPFox\PHPUnit\InheritanceAssertionsTrait;
use PHPUnit\Framework\TestCase;

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
    use InheritanceAssertionsTrait;

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
