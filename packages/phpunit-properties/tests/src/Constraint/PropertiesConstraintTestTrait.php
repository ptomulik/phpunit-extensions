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

use PHPFox\PHPUnit\Exception\InvalidArgumentException;
use PHPFox\PHPUnit\Properties\EqualityComparator;
use PHPFox\PHPUnit\Properties\ExpectedPropertiesInterface;
use PHPFox\PHPUnit\Properties\IdentityComparator;
use PHPFox\PHPUnit\Properties\RecursivePropertiesUnwrapper;
use PHPFox\PHPUnit\Properties\RecursivePropertiesUnwrapperInterface;
use PHPUnit\Framework\Constraint\IsIdentical;
use PHPUnit\Framework\Constraint\IsInstanceOf;
use PHPUnit\Framework\Constraint\UnaryOperator;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\MockObject;

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
     * Returns a builder object to create mock objects using a fluent interface.
     *
     * @psalm-template RealInstanceType of object
     * @psalm-param class-string<RealInstanceType> $className
     * @psalm-return MockBuilder<RealInstanceType>
     */
    abstract public function getMockBuilder(string $className): MockBuilder;

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

    public function testGetComparisonAdjectiveThrowsInvalidArgumentError(): void
    {
        $template = 'Argument #1 of %s::getComparisonAdjective() must be a comparator class name, FooBar given.';

        // self test
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf($template, self::class));

        self::getComparisonAdjective('FooBar');

        // @codeCoverageIgnoreStart
    }

    // @codeCoverageIgnoreEnd

    public function testExtendsAbstractPropertiesConstraint(): void
    {
        $class = self::getConstraintClass();
        self::assertExtendsClass(AbstractPropertiesConstraint::class, $class);
    }

    public function testImplementsExpectedPropertiesInterface(): void
    {
        $class = self::getConstraintClass();
        self::assertImplementsInterface(ExpectedPropertiesInterface::class, $class);
    }

    // @codeCoverageIgnoreStart
    public function provFromArray(): array
    {
        $class = self::getConstraintClass();
        $unwrapper = $this->createMock(RecursivePropertiesUnwrapperInterface::class);

        return [
            'PropertiesConstraintTestTrait.php:'.__LINE__ => [
                'class'  => $class,
                'args'   => [['foo' => 'FOO']],
                'expect' => [
                    'properties' => self::identicalTo(['foo' => 'FOO']),
                    'unwrapper'  => self::isInstanceOf(RecursivePropertiesUnwrapper::class),
                    'comparator' => self::isInstanceOf(self::getComparatorClass()),
                ],
            ],

            'PropertiesConstraintTestTrait.php:'.__LINE__ => [
                'class'  => $class,
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
        self::assertThat($constraint->getPropertiesUnwrapper(), $expect['unwrapper']);
        self::assertThat($constraint->getArrayCopy(), $expect['properties']);
        self::assertThat($constraint->getComparator(), $expect['comparator']);
    }

    // @codeCoverageIgnoreStart
    public static function provFromArrayThrowsInvalidArgumentException(): array
    {
        $class = self::getConstraintClass();
        $template = 'Argument #1 of %s::fromArray() must be an associative array with string keys, '.
                    'an array with %d non-string keys given';

        return [
            'PropertiesConstraintTestTrait.php:'.__LINE__ => [
                'class' => $class,
                'args'  => [
                    ['a' => 'A', 0 => 'B', 2 => 'C', 7 => 'D', 'e' => 'E'],
                ],
                'message' => sprintf($template, $class, 3),
            ],
        ];
    }

    // @codeCoverageIgnoreEnd

    /**
     * @dataProvider provFromArrayThrowsInvalidArgumentException
     */
    public function testFromArrayThrowsInvalidArgumentException(string $class, array $args, string $message): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);

        $class::fromArray(...$args);

        // @codeCoverageIgnoreStart
    }

    // @codeCoverageIgnoreEnd

    // for full coverage of failureDescriptionInContext()
    public function testFailureDescriptionOfCustomUnaryOperator(): void
    {
        $class = self::getConstraintClass();
        $constraint = $class::fromArray(['foo' => 'FOO']);

        $unary = $this->getMockBuilder(UnaryOperator::class)
            ->setConstructorArgs([$constraint])
            ->getMockForAbstractClass()
        ;

        $unary->expects(self::any())
            ->method('operator')
            ->willReturn('!')
        ;
        $unary->expects(self::any())
            ->method('precedence')
            ->willReturn(1)
        ;

        $adjective = self::getComparisonAdjective(self::getComparatorClass());
        $regexp = 'with properties '.$adjective.' specified';

        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessage($regexp);

        self::assertThat(null, $unary);

        // @codeCoverageIgnoreStart
    }

    // @codeCoverageIgnoreEnd

    /**
     * Assembles expected failure message out of pieces.
     *
     * @param string $value A noun representing the actual value, such as "123" or "array" or "object stdClass"
     * @param string $verbAndSubject A concatenated verb and subject, such as "is a class", or "fails to be an object"
     * @param string $adjective An adjective reflecting the comparison: "equal to" or "identical to"
     */
    private static function message(string $value, string $verbAndSubject, string $adjective): string
    {
        return sprintf('Failed asserting that %s.', self::statement($value, $verbAndSubject, $adjective));
    }

    /**
     * Assembles a statement which is a part of failure message.
     *
     * @param string $value A noun representing the actual value, such as "123" or "array" or "object stdClass"
     * @param string $verbAndSubject A concatenated verb and subject, such as "is a class", or "fails to be an object"
     * @param string $adjective An adjective reflecting the comparison: "equal to" or "identical to"
     */
    private static function statement(string $value, string $verbAndSubject, string $adjective): string
    {
        return sprintf('%s %s with properties %s specified', $value, $verbAndSubject, $adjective);
    }
}

// vim: syntax=php sw=4 ts=4 et: