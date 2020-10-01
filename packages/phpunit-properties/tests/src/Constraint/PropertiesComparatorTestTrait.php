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

use PHPFox\PHPUnit\Properties\ExpectedPropertiesInterface;
use PHPFox\PHPUnit\Properties\RecursivePropertiesUnwrapper;
use PHPFox\PHPUnit\Properties\RecursivePropertiesUnwrapperInterface;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 */
trait PropertiesComparatorTestTrait
{
    abstract public function getPropertiesComparatorClass(): string;

    abstract public static function assertExtendsClass(string $parent, $subject, string $message = ''): void;

    abstract public static function assertImplementsInterface(string $interface, $subject, string $message = ''): void;

    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference
     * the same object.
     *
     * @psalm-template ExpectedType
     * @psalm-param ExpectedType $expected
     * @psalm-assert =ExpectedType $actual
     *
     * @param mixed $expected
     * @param mixed $actual
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    abstract public static function assertSame($expected, $actual, string $message = ''): void;

    /**
     * Returns a mock object for the specified class.
     *
     * @psalm-template RealInstanceType of object
     * @psalm-param class-string<RealInstanceType> $originalClassName
     * @psalm-return MockObject&RealInstanceType
     */
    abstract public function createMock(string $originalClassName): MockObject;

    public function testExtendsAbstractPropertiesConstraint(): void
    {
        $class = $this->getPropertiesComparatorClass();
        $this->assertExtendsClass(AbstractPropertiesConstraint::class, $class);
    }

    public function testImplementsExpectedPropertiesInterface(): void
    {
        $class = $this->getPropertiesComparatorClass();
        $this->assertImplementsInterface(ExpectedPropertiesInterface::class, $class);
    }

    // @codeCoverageIgnoreStart
    public function provFromArray(): array
    {
        $unwrapper = $this->createMock(RecursivePropertiesUnwrapperInterface::class);

        return [
            'PropertiesComparatorTestTrait.php:'.__LINE__ => [
                'args'   => [['foo' => 'FOO']],
                'expect' => [
                    'properties' => ['foo' => 'FOO'],
                    'unwrapper'  => static::isInstanceOf(RecursivePropertiesUnwrapper::class),
                ],
            ],

            'PropertiesComparatorTestTrait.php:'.__LINE__ => [
                'args'   => [['foo' => 'FOO'], $unwrapper],
                'expect' => [
                    'properties' => ['foo' => 'FOO'],
                    'unwrapper'  => static::identicalTo($unwrapper),
                ],
            ],
        ];
    }

    // @codeCoverageIgnoreEnd

    /**
     * @dataProvider provFromArray
     */
    public function testFromArray(array $args, array $expect): void
    {
        $class      = $this->getPropertiesComparatorClass();
        $constraint = $class::fromArray(...$args);
        $this->assertThat($constraint->getPropertiesUnwrapper(), $expect['unwrapper']);
        $this->assertSame($expect['properties'], $constraint->getArrayCopy());
    }
}

// vim: syntax=php sw=4 ts=4 et:
