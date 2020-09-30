<?php declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Constraint;

use Error;
use ErrorException;
use Exception;
use PHPFox\PHPUnit\Examples\Inheritance\ExampleTrait;
use PHPFox\PHPUnit\Exception\InvalidArgumentException;
use PHPUnit\Framework\Constraint\UnaryOperator;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Throwable;

/**
 * @small
 * @covers \PHPFox\PHPUnit\Constraint\ExtendsClass
 *
 * @internal
 */
final class ExtendsClassTest extends TestCase
{
    public static function provExtendsClass(): array
    {
        return [
            // class extends class
            [
                'class'   => Exception::class,
                'subject' => ErrorException::class,
            ],

            // object of class that extends class
            [
                'class'   => Exception::class,
                'subject' => new ErrorException(),
            ],
        ];
    }

    public static function provNotExtendsClass(): array
    {
        $template = 'Failed asserting that %s extends class %s.';

        return [
            [
                'class'   => Error::class,
                'subject' => ErrorException::class,
                'message' => sprintf($template, ErrorException::class, Error::class),
            ],
            [
                'class'   => Error::class,
                'subject' => new ErrorException(),
                'message' => sprintf($template, 'object '.ErrorException::class, Error::class),
            ],
            [
                'class'   => Error::class,
                'subject' => 'lorem ipsum',
                'message' => sprintf($template, "'lorem ipsum'", Error::class),
            ],
            [
                'class'   => Error::class,
                'subject' => 123,
                'message' => sprintf($template, '123', Error::class),
            ],
        ];
    }

    public static function provConstraintThrowsInvalidArgumentException(): array
    {
        $message = '/Argument #1 of \S+ must be a class-string/';

        return [
            [
                'argument' => 'non-class string',
                'messsage' => $message,
            ],

            [
                'argument' => Throwable::class,
                'messsage' => $message,
            ],

            [
                'argument' => ExampleTrait::class,
                'messsage' => $message,
            ],
        ];
    }

    /**
     * @dataProvider provExtendsClass
     *
     * @param mixed $subject
     */
    public function testConstraintSucceeds(string $class, $subject): void
    {
        $constraint = ExtendsClass::fromClassString($class);

        self::assertTrue($constraint->evaluate($subject, '', true));
    }

    /**
     * @dataProvider provNotExtendsClass
     *
     * @param mixed $subject
     */
    public function testConstraintFails(string $class, $subject, string $message): void
    {
        $constraint = ExtendsClass::fromClassString($class);

        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessage($message);

        $constraint->evaluate($subject);
    }

    /**
     * @dataProvider provConstraintThrowsInvalidArgumentException
     */
    public function testConstraintThrowsInvalidArgumentException(string $argument, string $message): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessageMatches($message);

        ExtendsClass::fromClassString($argument);
    }

    public function testFailureDescriptionOfCustomUnaryOperator(): void
    {
        $constraint = ExtendsClass::fromClassString(ErrorException::class);

        $noop = $this->getMockBuilder(UnaryOperator::class)
            ->setConstructorArgs([$constraint])
            ->getMockForAbstractClass()
        ;

        $noop->expects($this->any())
            ->method('operator')
            ->willReturn('noop')
        ;
        $noop->expects($this->any())
            ->method('precedence')
            ->willReturn(1)
        ;

        $regexp = '/Exception extends class ErrorException/';

        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessageMatches($regexp);

        $noop->evaluate(Exception::class);
    }
}
