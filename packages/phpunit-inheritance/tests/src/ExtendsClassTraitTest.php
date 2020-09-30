<?php

declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit;

use PHPFox\PHPUnit\Constraint\ExtendsClass;
use PHPFox\PHPUnit\Examples\Inheritance\ExampleTrait;
use PHPFox\PHPUnit\Exception\InvalidArgumentException;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @small
 * @covers \PHPFox\PHPUnit\ExtendsClassTrait
 *
 * @internal
 */
final class ExtendsClassTraitTest extends TestCase
{
    use ExtendsClassTrait;

    //
    // extendsClass
    //

    public static function provExtendsClass(): array
    {
        $template = 'Failed asserting that %s does not extend class %s.';

        return [
            'ExtendsClassTraitTest.php:'.__LINE__ => [
                'class'   => \Exception::class,
                'subject' => \ErrorException::class,
                'message' => sprintf($template, \ErrorException::class, \Exception::class),
            ],

            'ExtendsClassTraitTest.php:'.__LINE__ => [
                'class'   => \Exception::class,
                'subject' => new \ErrorException(),
                'message' => sprintf($template, 'object '.\ErrorException::class, \Exception::class),
            ],
        ];
    }

    public static function provNotExtendsClass(): array
    {
        $template = 'Failed asserting that %s extends class %s.';

        return [
            'ExtendsClassTraitTest.php:'.__LINE__ => [
                'class'   => \Error::class,
                'subject' => \ErrorException::class,
                'message' => sprintf($template, \ErrorException::class, \Error::class),
            ],
            'ExtendsClassTraitTest.php:'.__LINE__ => [
                'class'   => \Error::class,
                'subject' => new \ErrorException(),
                'message' => sprintf($template, 'object '.\ErrorException::class, \Error::class),
            ],
            'ExtendsClassTraitTest.php:'.__LINE__ => [
                'class'   => \Error::class,
                'subject' => 'lorem ipsum',
                'message' => sprintf($template, "'lorem ipsum'", \Error::class),
            ],
            'ExtendsClassTraitTest.php:'.__LINE__ => [
                'class'   => \Error::class,
                'subject' => 123,
                'message' => sprintf($template, '123', \Error::class),
            ],
        ];
    }

    /**
     * @dataProvider provExtendsClass
     *
     * @param mixed $subject
     */
    public function testAssertExtendsClassSucceeds(string $class, $subject): void
    {
        self::assertExtendsClass($class, $subject);
    }

    /**
     * @dataProvider provNotExtendsClass
     *
     * @param mixed $subject
     */
    public function testAssertExtendsClassFails(string $class, $subject, string $message): void
    {
        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessage($message);

        self::assertExtendsClass($class, $subject);
    }

    /**
     * @dataProvider provNotExtendsClass
     *
     * @param mixed $subject
     */
    public function testAssertNotExtendsClassSucceeds(string $class, $subject): void
    {
        self::assertNotExtendsClass($class, $subject);
    }

    /**
     * @dataProvider provExtendsClass
     *
     * @param mixed $subject
     */
    public function testAssertNotExtendsClassFails(string $class, $subject, string $message): void
    {
        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessage($message);

        self::assertNotExtendsClass($class, $subject);
    }

    /**
     * @dataProvider provExtendsClass
     *
     * @param mixed $subject
     */
    public function testExtendsClass(string $class, $subject): void
    {
        self::assertThat($subject, self::extendsClass($class));
    }

    /**
     * @dataProvider provNotExtendsClass
     *
     * @param mixed $subject
     */
    public function testNotExtendsClass(string $class, $subject): void
    {
        self::assertThat($subject, self::logicalNot(self::extendsClass($class)));
    }

    public static function provExtendsClassThrowsInvalidArgumentException(): array
    {
        $template = 'Argument #1 of %s::fromClassString() must be a class-string';

        return [
            'ExtendsClassTraitTest.php:'.__LINE__ => [
                'argument' => 'non-class string',
                'messsage' => sprintf($template, ExtendsClass::class),
            ],

            'ExtendsClassTraitTest.php:'.__LINE__ => [
                'argument' => \Throwable::class,
                'messsage' => sprintf($template, ExtendsClass::class),
            ],

            'ExtendsClassTraitTest.php:'.__LINE__ => [
                'argument' => ExampleTrait::class,
                'messsage' => sprintf($template, ExtendsClass::class),
            ],
        ];
    }

    /**
     * @dataProvider provExtendsClassThrowsInvalidArgumentException
     */
    public function testExtendsClassThrowsInvalidArgumentException(string $argument, string $message): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage($message);

        self::extendsClass($argument);
    }
}

// vim: syntax=php sw=4 ts=4 et:
