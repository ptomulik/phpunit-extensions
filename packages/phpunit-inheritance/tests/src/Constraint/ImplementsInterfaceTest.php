<?php declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Constraint;

use Exception;
use Iterator;
use PHPFox\PHPUnit\Examples\Inheritance\ExampleTrait;
use PHPFox\PHPUnit\Exception\InvalidArgumentException;
use PHPUnit\Framework\Constraint\UnaryOperator;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Throwable;
use Traversable;

/**
 * @small
 * @covers \PHPFox\PHPUnit\Constraint\ImplementsInterface
 *
 * @internal
 */
final class ImplementsInterfaceTest extends TestCase
{
    public static function provImplementsInterface(): array
    {
        return [
            // class implements interface
            [
                'interface' => Throwable::class,
                'subject'   => Exception::class,
            ],

            // object of class that implements interface
            [
                'interface' => Throwable::class,
                'subject'   => new Exception(),
            ],

            // interface that extends interface
            [
                'interface' => Traversable::class,
                'subject'   => Iterator::class,
            ],
        ];
    }

    public static function provNotImplementsInterface(): array
    {
        $template = 'Failed asserting that %s implements interface %s.';

        return [
            [
                'interface' => Traversable::class,
                'subject'   => Exception::class,
                'message'   => sprintf($template, Exception::class, Traversable::class),
            ],
            [
                'interface' => Traversable::class,
                'subject'   => new Exception(),
                'message'   => sprintf($template, 'object '.Exception::class, Traversable::class),
            ],
            [
                'interface' => Traversable::class,
                'subject'   => 'lorem ipsum',
                'message'   => sprintf($template, "'lorem ipsum'", Traversable::class),
            ],
            [
                'interface' => Traversable::class,
                'subject'   => 123,
                'message'   => sprintf($template, '123', Traversable::class),
            ],
        ];
    }

    public static function provConstraintThrowsInvalidArgumentException(): array
    {
        $message = '/Argument #1 of \S+ must be an interface-string/';

        return [
            [
                'argument' => 'non-interface string',
                'messsage' => $message,
            ],

            [
                'argument' => Exception::class,
                'messsage' => $message,
            ],

            [
                'argument' => ExampleTrait::class,
                'messsage' => $message,
            ],
        ];
    }

    /**
     * @dataProvider provImplementsInterface
     *
     * @param mixed $subject
     */
    public function testConstraintSucceeds(string $interface, $subject): void
    {
        $constraint = ImplementsInterface::fromInterfaceString($interface);

        self::assertTrue($constraint->evaluate($subject, '', true));
    }

    /**
     * @dataProvider provNotImplementsInterface
     *
     * @param mixed $subject
     */
    public function testConstraintFails(string $interface, $subject, string $message): void
    {
        $constraint = ImplementsInterface::fromInterfaceString($interface);

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

        ImplementsInterface::fromInterfaceString($argument);
    }

    public function testFailureDescriptionOfCustomUnaryOperator(): void
    {
        $constraint = ImplementsInterface::fromInterfaceString(Throwable::class);

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

        $regexp = '/Iterator implements interface Throwable/';

        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessageMatches($regexp);

        $noop->evaluate(Iterator::class);
    }
}
