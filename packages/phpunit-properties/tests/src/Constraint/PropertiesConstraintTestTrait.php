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
use PHPFox\PHPUnit\Properties\EqualityComparator;
use PHPFox\PHPUnit\Properties\IdentityComparator;
use PHPFox\PHPUnit\Exception\InvalidArgumentException;
use PHPUnit\Framework\Constraint\IsIdentical;
use PHPUnit\Framework\Constraint\IsInstanceOf;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 */
trait PropertiesConstraintTestTrait
{
    abstract public static function getConstraintClass(): string;

    abstract public static function getComparatorClass(): string;

    abstract public static function assertExtendsClass(string $parent, $subject, string $message = ''): void;

    abstract public static function assertImplementsInterface(string $interface, $subject, string $message = ''): void;

    abstract public static function identicalTo($value): IsIdentical;

    abstract public static function isInstanceOf(string $className): IsInstanceOf;

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

    /**
     * @psalm-template Comparator of EqualityComparator|IdentityComparator
     * @psalm-assert class-string<Comparator> $comparator
     *
     * @throws InvalidArgumentException
     */
    public static function getComparisonAdjective(string $comparator): string
    {
        switch ($comparator) {
        case EqualityComparator::class:
            return 'equal to';
        case IdentityComparator::class:
            return 'identical to';
        default:
            throw InvalidArgumentException::fromBackTrace(1, 'a comparator class name', $comparator);
        }
    }

    public function testExtendsAbstractPropertiesConstraint(): void
    {
        $class = $this->getConstraintClass();
        $this->assertExtendsClass(AbstractPropertiesConstraint::class, $class);
    }

    public function testImplementsExpectedPropertiesInterface(): void
    {
        $class = $this->getConstraintClass();
        $this->assertImplementsInterface(ExpectedPropertiesInterface::class, $class);
    }

    // @codeCoverageIgnoreStart
    public function provFromArray(): array
    {
        $class      = self::getConstraintClass();
        $unwrapper = $this->createMock(RecursivePropertiesUnwrapperInterface::class);

        return [
            'PropertiesConstraintTestTrait.php:'.__LINE__ => [
                'class' => $class,
                'args'   => [['foo' => 'FOO']],
                'expect' => [
                    'properties' => self::identicalTo(['foo' => 'FOO']),
                    'unwrapper'  => self::isInstanceOf(RecursivePropertiesUnwrapper::class),
                    'comparator' => self::isInstanceOf(self::getComparatorClass()),
                ],
            ],

            'PropertiesConstraintTestTrait.php:'.__LINE__ => [
                'class' => $class,
                'args'   => [['foo' => 'FOO'], $unwrapper],
                'expect' => [
                    'properties' => self::identicalTo(['foo' => 'FOO']),
                    'unwrapper'  => self::identicalTo($unwrapper),
                    'comparator' => self::isInstanceOf(self::getComparatorClass()),
                ],
            ],
        ];
    }

    // @codeCoverageIgnoreEnd

    /**
     * @dataProvider provFromArray
     */
    public function testFromArray(string $class, array $args, array $expect): void
    {
        $constraint = $class::fromArray(...$args);
        $this->assertThat($constraint->getPropertiesUnwrapper(), $expect['unwrapper']);
        $this->assertThat($constraint->getArrayCopy(), $expect['properties']);
        $this->assertThat($constraint->getComparator(), $expect['comparator']);
    }

    public static function provFromArrayThrowsInvalidArgumentException(): array
    {
        $class = self::getConstraintClass();
        $template = 'Argument #1 of %s::fromArray() must be an associative array with string keys, '.
                    'an array with %d non-string keys given';

        return [
            'PropertiesConstraintTestTrait.php:'.__LINE__ => [
                'class' => $class,
                'args' =>  [
                    ['a' => 'A', 0 => 'B', 2 => 'C', 7 => 'D', 'e' => 'E',],
                ],
                'message' => sprintf($template, $class, 3)
            ]
        ];
    }

    /**
     * @dataProvider provFromArrayThrowsInvalidArgumentException
     */
    public function testFromArrayThrowsInvalidArgumentException(string $class, array $args, string $message): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);

        $class::fromArray(...$args);
    }
}

// vim: syntax=php sw=4 ts=4 et:
