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

use PHPFox\PHPUnit\Properties\ExpectedProperties;
use PHPFox\PHPUnit\Properties\ExpectedPropertiesDecoratorTrait;
use PHPFox\PHPUnit\Properties\ExpectedPropertiesInterface;
use PHPFox\PHPUnit\Properties\PropertiesInterface;
use PHPFox\PHPUnit\Properties\PropertySelectorInterface;
use PHPFox\PHPUnit\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Properties\ExpectedPropertiesDecoratorTrait
 *
 * @internal
 */
final class ExpectedPropertiesDecoratorTraitTest extends TestCase
{
    // required by ExpectedPropertiesTestTrait
    public function createExpectedProperties(
        PropertySelectorInterface $selector,
        ...$args
    ): ExpectedPropertiesInterface {
        $properties = new ExpectedProperties($selector, ...$args);

        return $this->createDummyInstance($properties);
    }

    public static function createDummyInstance(ExpectedPropertiesInterface $wrapped): ExpectedPropertiesInterface
    {
        return new class($wrapped) implements ExpectedPropertiesInterface {
            use ExpectedPropertiesDecoratorTrait;

            private $wrapped;

            public function __construct(ExpectedPropertiesInterface $wrapped)
            {
                $this->wrapped = $wrapped;
            }

            public function getExpectedProperties(): ExpectedPropertiesInterface
            {
                return $this->wrapped;
            }
        };
    }

    //
    //
    // TESTS
    //
    //

    //
    // getIterator()
    //

    public function testGetIteratorInvokesAdapteeMethod(): void
    {
        $iterator = $this->createMock(\Traversable::class);
        $adaptee = $this->createMock(ExpectedPropertiesInterface::class);
        $adaptee->expects($this->once())
            ->method('getIterator')
            ->willReturn($iterator)
        ;
        $properties = $this->createDummyInstance($adaptee);
        $this->assertSame($iterator, $properties->getIterator());
    }

    //
    // offsetExists()
    //

    public function testOffsetExistsInvokesAdapteeMethod(): void
    {
        $adaptee = $this->createMock(ExpectedPropertiesInterface::class);
        $adaptee->expects($this->once())
            ->method('offsetExists')
            ->with(123)
            ->willReturn(true)
        ;
        $properties = $this->createDummyInstance($adaptee);
        $this->assertTrue($properties->offsetExists(123));
    }

    //
    // offsetGet()
    //

    public function testOffsetGetInvokesAdapteeMethod(): void
    {
        $value = new \StdClass();
        $adaptee = $this->createMock(ExpectedPropertiesInterface::class);
        $adaptee->expects($this->once())
            ->method('offsetGet')
            ->with(123)
            ->willReturn($value)
        ;
        $properties = $this->createDummyInstance($adaptee);
        $this->assertSame($value, $properties->offsetGet(123));
    }

    //
    // offsetSet()
    //

    public function testOffsetSetInvokesAdapteeMethod(): void
    {
        $value = new \StdClass();
        $adaptee = $this->createMock(ExpectedPropertiesInterface::class);
        $adaptee->expects($this->once())
            ->method('offsetSet')
            ->with(123, $value)
        ;
        $properties = $this->createDummyInstance($adaptee);
        $properties->offsetSet(123, $value);
    }

    //
    // offsetUnset()
    //

    public function testOffsetUnsetInvokesAdapteeMethod(): void
    {
        $adaptee = $this->createMock(ExpectedPropertiesInterface::class);
        $adaptee->expects($this->once())
            ->method('offsetUnset')
            ->with(123)
        ;
        $properties = $this->createDummyInstance($adaptee);
        $properties->offsetUnset(123);
    }

    //
    // count()
    //

    public function testCountInvokesAdapteeMethod(): void
    {
        $adaptee = $this->createMock(ExpectedPropertiesInterface::class);
        $adaptee->expects($this->once())
            ->method('count')
            ->willReturn(123)
        ;
        $properties = $this->createDummyInstance($adaptee);
        $this->assertSame(123, $properties->count());
    }

    //
    // getArrayCopy()
    //

    public function testGetArrayCopyInvokesAdapteeMethod(): void
    {
        $array = ['foo' => 'FOO'];
        $adaptee = $this->createMock(ExpectedPropertiesInterface::class);
        $adaptee->expects($this->once())
            ->method('getArrayCopy')
            ->willReturn($array)
        ;
        $properties = $this->createDummyInstance($adaptee);
        $this->assertSame($array, $properties->getArrayCopy());
    }

    //
    // canUnwrapChild()
    //

    public function testCanUnwrapChildInvokesAdapteeMethod(): void
    {
        $child = $this->createMock(PropertiesInterface::class);
        $adaptee = $this->createMock(ExpectedPropertiesInterface::class);
        $adaptee->expects($this->once())
            ->method('canUnwrapChild')
            ->with($child)
            ->willReturn(true)
        ;
        $properties = $this->createDummyInstance($adaptee);
        $this->assertTrue($properties->canUnwrapChild($child));
    }

    //
    // getPropertySelector()
    //

    public function testGetPropertySelectorInvokesAdapteeMethod(): void
    {
        $selector = $this->createMock(PropertySelectorInterface::class);
        $adaptee = $this->createMock(ExpectedPropertiesInterface::class);
        $adaptee->expects($this->once())
            ->method('getPropertySelector')
            ->willReturn($selector)
        ;
        $properties = $this->createDummyInstance($adaptee);
        $this->assertSame($selector, $properties->getPropertySelector());
    }
}
// vim: syntax=php sw=4 ts=4 et:
