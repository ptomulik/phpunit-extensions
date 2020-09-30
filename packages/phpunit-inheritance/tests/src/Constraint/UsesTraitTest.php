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
use PHPFox\PHPUnit\Examples\Inheritance\ExampleClassNotUsingTrait;
use PHPFox\PHPUnit\Examples\Inheritance\ExampleClassUsingTrait;
use PHPFox\PHPUnit\Examples\Inheritance\ExampleTrait;
use PHPFox\PHPUnit\Examples\Inheritance\ExampleTraitUsingTrait;
use PHPFox\PHPUnit\Exception\InvalidArgumentException;
use PHPUnit\Framework\Constraint\UnaryOperator;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Throwable;

/**
 * @small
 * @covers \PHPFox\PHPUnit\Constraint\UsesTrait
 *
 * @internal
 */
final class UsesTraitTest extends TestCase
{
    public static function provUsesTrait(): array
    {
        return [
            [
                'trait'   => ExampleTrait::class,
                'subject' => ExampleClassUsingTrait::class,
            ],
            [
                'trait'   => ExampleTrait::class,
                'subject' => new ExampleClassUsingTrait(),
            ],
            [
                'trait'   => ExampleTrait::class,
                'subject' => ExampleTraitUsingTrait::class,
            ],
        ];
    }

    public static function provNotUsesTrait(): array
    {
        $template = 'Failed asserting that %s uses trait %s.';

        return [
            [
                'trait'   => ExampleTrait::class,
                'subject' => ExampleClassNotUsingTrait::class,
                'message' => sprintf($template, ExampleClassNotUsingTrait::class, ExampleTrait::class),
            ],
            [
                'trait'   => ExampleTrait::class,
                'subject' => new ExampleClassNotUsingTrait(),
                'message' => sprintf($template, 'object '.ExampleClassNotUsingTrait::class, ExampleTrait::class),
            ],
            [
                'trait'   => ExampleTrait::class,
                'subject' => 'lorem ipsum',
                'message' => sprintf($template, "'lorem ipsum'", ExampleTrait::class),
            ],
            [
                'trait'   => ExampleTrait::class,
                'subject' => 123,
                'message' => sprintf($template, '123', ExampleTrait::class),
            ],
        ];
    }

    public static function provConstraintThrowsInvalidArgumentException(): array
    {
        $message = '/Argument #1 of \S+ must be a trait-string/';

        return [
            [
                'argument' => 'non-trait string',
                'messsage' => $message,
            ],

            [
                'argument' => Exception::class,
                'messsage' => $message,
            ],

            [
                'argument' => Throwable::class,
                'messsage' => $message,
            ],
        ];
    }

    /**
     * @dataProvider provUsesTrait
     *
     * @param mixed $subject
     */
    public function testConstraintSucceeds(string $trait, $subject): void
    {
        $constraint = UsesTrait::fromTraitString($trait);

        self::assertTrue($constraint->evaluate($subject, '', true));
    }

    /**
     * @dataProvider provNotUsesTrait
     *
     * @param mixed $subject
     */
    public function testConstraintFails(string $trait, $subject, string $message): void
    {
        $constraint = UsesTrait::fromTraitString($trait);

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

        UsesTrait::fromTraitString($argument);
    }

    public function testFailureDescriptionOfCustomUnaryOperator(): void
    {
        $constraint = UsesTrait::fromTraitString(ExampleTrait::class);

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

        $regexp = '/Exception uses trait '.preg_quote(ExampleTrait::class, '/').'/';

        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessageMatches($regexp);

        $noop->evaluate(Exception::class);
    }
}
