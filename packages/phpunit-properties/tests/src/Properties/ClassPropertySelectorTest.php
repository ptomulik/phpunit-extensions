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

use PHPUnit\Framework\TestCase;
use PHPFox\PHPUnit\InheritanceAssertionsTrait;

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
    use InheritanceAssertionsTrait;

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
