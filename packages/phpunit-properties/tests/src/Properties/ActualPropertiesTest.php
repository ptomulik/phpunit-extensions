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

use PHPFox\PHPUnit\Properties\ActualProperties;
use PHPFox\PHPUnit\Properties\ActualPropertiesInterface;
use PHPFox\PHPUnit\Properties\ExpectedProperties;
use PHPFox\PHPUnit\Properties\PropertiesInterface;
use PHPFox\PHPUnit\Properties\PropertySelectorInterface;
use PHPFox\PHPUnit\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Properties\ActualProperties
 *
 * @internal
 */
final class ActualPropertiesTest extends TestCase
{
    //
    //
    // TESTS
    //
    //

    public function testImplementsActualPropertiesInterface(): void
    {
        $this->assertImplementsInterface(ActualPropertiesInterface::class, ActualProperties::class);
    }

    public function testExtendsArrayObject(): void
    {
        $this->assertExtendsClass(\ArrayObject::class, ActualProperties::class);
    }

    //
    // __construct()
    //

    public static function provConstruct(): array
    {
        return [
            // #0
            [
                'args' => [],
                'expect' => [],
            ],

            // #1
            [
                'args' => [[]],
                'expect' => [],
            ],

            // #2
            [
                'args' => [['foo' => 'FOO']],
                'expect' => ['foo' => 'FOO'],
            ],
        ];
    }

    /**
     * @dataProvider provConstruct
     */
    public function testConstruct(array $args, array $expect): void
    {
        $properties = new ActualProperties(...$args);

        $this->assertSame($expect, $properties->getArrayCopy());
        $this->assertSame($expect, (array) $properties);
    }

    //
    // canUnwrapChild()
    //

    public function provCanUnwrapChild(): array
    {
        $selector = $this->createMock(PropertySelectorInterface::class);

        return [
            // #0
            [
                'parent' => new ActualProperties(),
                'child' => new ExpectedProperties($selector),
                'expect' => false,
            ],

            // #1
            [
                'parent' => new ActualProperties(),
                'child' => new ActualProperties(),
                'expect' => true,
            ],
        ];
    }

    /**
     * @dataProvider provCanUnwrapChild
     */
    public function testCanUnwrapChild(PropertiesInterface $parent, PropertiesInterface $child, bool $expect): void
    {
        $this->assertSame($expect, $parent->canUnwrapChild($child));
    }
}
// vim: syntax=php sw=4 ts=4 et:
