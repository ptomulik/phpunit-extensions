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

use PHPUnit\Framework\Constraint\UnaryOperator;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \PHPFox\PHPUnit\ClassPropertiesEqualToTrait
 * @small
 *
 * @internal
 */
final class ClassPropertiesEqualToTraitTest extends TestCase
{
    use ClassPropertiesEqualToTrait;

//    public static function provConstraintWithInvalidExpectationSpec(): array
//    {
//        $specs = [
//            '3-int-keys' => [
//                'array' => [
//                    'a' => 'A', 0 => 'B', 2 => 'C', 7 => 'D', 'e' => 'E',
//                ],
//                'expect' => [
//                    'exception' => \PHPFox\PHPUnit\Exception\InvalidArgumentException::class,
//                    'message'   => 'The array of expected properties contains 3 invalid key(s)',
//                ],
//            ],
//        ];
//
//        return [
//            'ClassPropertiesEqualToTraitTest.php:'.__LINE__ => [
//                'method' => 'objectPropertiesIdenticalTo',
//            ] + $specs['3-int-keys'],
//
//            'ClassPropertiesEqualToTraitTest.php:'.__LINE__ => [
//                'method' => 'objectPropertiesEqualTo',
//            ] + $specs['3-int-keys'],
//
//            'ClassPropertiesEqualToTraitTest.php:'.__LINE__ => [
//                'method' => 'classPropertiesIdenticalTo',
//            ] + $specs['3-int-keys'],
//
//            'ClassPropertiesEqualToTraitTest.php:'.__LINE__ => [
//                'method' => 'classPropertiesEqualTo',
//            ] + $specs['3-int-keys'],
//        ];
//    }
//
//    /**
//     * @dataProvider provConstraintWithInvalidExpectationSpec
//     */
//    public function testConstraintWithInvalidExpectationSpec(string $method, array $array, array $expect): array
//    {
//        self::expectException($expect['exception']);
//        self::expectExceptionMessage($expect['message']);
//
//        call_user_func([self::class, $method], $array);
//    }
//
//    public static function provAssertionWithIncompatibleValue(): array
//    {
//        return [
//            'ClassPropertiesEqualToTraitTest.php:'.__LINE__ => [
//                'method' => 'objectPropertiesIdenticalTo',
//                'array'  => ['foo' => 'FOO'],
//                'value'  => 123,
//                'expect' => [
//                    'exception' => ExpectationFailedException::class,
//                    'message'   => '/^Failed asserting that 123 is an object with properties identical to specified.$/',
//                ],
//            ],
//
//            'ClassPropertiesEqualToTraitTest.php:'.__LINE__ => [
//                'method' => 'objectPropertiesEqualTo',
//                'array'  => ['foo' => 'FOO'],
//                'value'  => 123,
//                'expect' => [
//                    'exception' => ExpectationFailedException::class,
//                    'message'   => '/^Failed asserting that 123 is an object with properties equal to specified.$/',
//                ],
//            ],
//
//            'ClassPropertiesEqualToTraitTest.php:'.__LINE__ => [
//                'method' => 'classPropertiesIdenticalTo',
//                'array'  => ['foo' => 'FOO'],
//                'value'  => 123,
//                'expect' => [
//                    'exception' => ExpectationFailedException::class,
//                    'message'   => '/^Failed asserting that 123 is a class with properties identical to specified.$/',
//                ],
//            ],
//
//            'ClassPropertiesEqualToTraitTest.php:'.__LINE__ => [
//                'method' => 'classPropertiesEqualTo',
//                'array'  => ['foo' => 'FOO'],
//                'value'  => 123,
//                'expect' => [
//                    'exception' => ExpectationFailedException::class,
//                    'message'   => '/^Failed asserting that 123 is a class with properties equal to specified.$/',
//                ],
//            ],
//        ];
//    }
//
//    /**
//     * @dataProvider provAssertionWithIncompatibleValue
//     *
//     * @param mixed $value
//     */
//    public function testAssertionWithIncompatibleValue(string $method, array $array, $value, array $expect): void
//    {
//        $matcher = call_user_func([self::class, $method], $array);
//
//        self::expectException($expect['exception']);
//        self::expectExceptionMessageMatches($expect['message']);
//
//        self::assertThat($value, $matcher);
//    }
//
//
    //
    // class
    //

    public static function provClassPropertiesIdenticalTo(): array
    {
        return [
            'ClassPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => [
                    'emptyString' => '',
                    'null'        => null,
                    'string123'   => '123',
                    'int321'      => 321,
                    'boolFalse'   => false,
                ],
                'class' => get_class(new class() {
                    public static $emptyString = '';
                    public static $null;
                    public static $string123 = '123';
                    public static $int321 = 321;
                    public static $boolFalse = false;
                }),
            ],
        ];
    }

    public static function provClassPropertiesEqualButNotIdenticalTo(): array
    {
        return [
            'ClassPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => [
                    'emptyString' => null,
                    'null'        => '',
                    'string123'   => 123,
                    'int321'      => '321',
                    'boolFalse'   => 0,
                ],
                'class' => get_class(new class() {
                    public static $emptyString = '';
                    public static $null;
                    public static $string123 = '123';
                    public static $int321 = 321;
                    public static $boolFalse = false;
                }),
            ],
        ];
    }

    public static function provClassPropertiesNotEqualTo(): array
    {
        return [
            'ClassPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => [
                    'emptyString' => 'foo',
                    'null'        => 1,
                    'string123'   => '321',
                    'int321'      => 123,
                    'boolFalse'   => true,
                ],
                'class' => get_class(new class() {
                    public static $emptyString = '';
                    public static $null;
                    public static $string123 = '123';
                    public static $int321 = 321;
                    public static $boolFalse = false;
                }),
            ],
        ];
    }

//    /**
//     * @dataProvider provClassPropertiesIdenticalTo
//     */
//    public function testClassPropertiesIdenticalTo(array $expect, string $class)
//    {
//        self::assertThat($class, self::classPropertiesIdenticalTo($expect));
//    }
//
//    /**
//     * @dataProvider provClassPropertiesNotEqualTo
//     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
//     */
//    public function testLogicalNotClassPropertiesIdenticalTo(array $expect, string $class)
//    {
//        self::assertThat($class, self::logicalNot(self::classPropertiesIdenticalTo($expect)));
//    }
//
//    /**
//     * @dataProvider provClassPropertiesIdenticalTo
//     */
//    public function testAssertClassPropertiesIdenticalTo(array $expect, string $class)
//    {
//        self::assertClassPropertiesIdenticalTo($expect, $class);
//    }
//
//    /**
//     * @dataProvider provClassPropertiesNotEqualTo
//     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
//     */
//    public function testAssertClassPropertiesIdenticalToFails(array $expect, string $class)
//    {
//        $regexp = '/^Lorem ipsum.\n'.
//            'Failed asserting that .+ is a class '.
//            'with properties identical to specified./';
//        self::expectException(ExpectationFailedException::class);
//        self::expectExceptionMessageMatches($regexp);
//
//        self::assertClassPropertiesIdenticalTo($expect, $class, 'Lorem ipsum.');
//    }
//
//    /**
//     * @dataProvider provClassPropertiesNotEqualTo
//     */
//    public function testAssertNotClassPropertiesIdenticalTo(array $expect, string $class)
//    {
//        self::assertNotClassPropertiesIdenticalTo($expect, $class);
//    }
//
//    /**
//     * @dataProvider provClassPropertiesIdenticalTo
//     */
//    public function testAssertNotClassPropertiesIdenticalToFails(array $expect, string $class)
//    {
//        $regexp = '/^Lorem ipsum.\n'.
//            'Failed asserting that .+ fails to be a class '.
//            'with properties identical to specified./';
//        self::expectException(ExpectationFailedException::class);
//        self::expectExceptionMessageMatches($regexp);
//
//        self::assertNotClassPropertiesIdenticalTo($expect, $class, 'Lorem ipsum.');
//    }

    /**
     * @dataProvider provClassPropertiesIdenticalTo
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     */
    public function testClassPropertiesEqualTo(array $expect, string $class)
    {
        self::assertThat($class, self::classPropertiesEqualTo($expect));
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     */
    public function testLogicalNotClassPropertiesEqualTo(array $expect, string $class)
    {
        self::assertThat($class, self::logicalNot(self::classPropertiesEqualTo($expect)));
    }

    /**
     * @dataProvider provClassPropertiesIdenticalTo
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     */
    public function testAssertClassPropertiesEqualTo(array $expect, string $class)
    {
        self::assertClassPropertiesEqualTo($expect, $class);
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     */
    public function testAssertClassPropertiesEqualToFails(array $expect, string $class)
    {
        $regexp = '/^Lorem ipsum.\n'.
            'Failed asserting that .+ is a class '.
            'with properties equal to specified./';
        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessageMatches($regexp);

        self::assertClassPropertiesEqualTo($expect, $class, 'Lorem ipsum.');
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     */
    public function testAssertNotClassPropertiesEqualTo(array $expect, string $class)
    {
        self::assertNotClassPropertiesEqualTo($expect, $class);
    }

    /**
     * @dataProvider provClassPropertiesIdenticalTo
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     */
    public function testAssertNotClassPropertiesEqualToFails(array $expect, string $class)
    {
        $regexp = '/^Lorem ipsum.\n'.
            'Failed asserting that .+ fails to be a class '.
            'with properties equal to specified./';
        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessageMatches($regexp);

        self::assertNotClassPropertiesEqualTo($expect, $class, 'Lorem ipsum.');
    }

//    //
//    // misc.
//    //
//
//    public function testObjectPropertiesConstraintsWithAndOperator(): void
//    {
//        self::assertThat(
//            new class() {
//                public $foo = 'FOO';
//                public $bar = '';
//            },
//            self::logicalAnd(
//                self::objectPropertiesIdenticalTo([
//                    'foo' => 'FOO',
//                ]),
//                self::objectPropertiesEqualTo([
//                    'bar' => null,
//                ])
//            )
//        );
//    }
//
//    public function testObjectPropertiesConstraintsWithAndOperatorFails(): void
//    {
//        $regexp = '/is an object with properties identical to specified'.
//            ' and is an object with properties equal to specified/';
//
//        self::expectException(ExpectationFailedException::class);
//        self::expectExceptionMessageMatches($regexp);
//
//        self::assertThat(
//            new class() {
//                public $foo = '';
//                public $bar = 'BAR';
//            },
//            self::logicalAnd(
//                self::objectPropertiesIdenticalTo([
//                    'foo' => 'FOO',
//                ]),
//                self::objectPropertiesEqualTo([
//                    'bar' => null,
//                ])
//            )
//        );
//    }
//
//    // for full coverage of failureDescriptionInContext()
//    public function testFailureDescriptionOfCustomUnaryOperator(): void
//    {
//        $constraint = self::objectPropertiesIdenticalTo([
//            'foo' => 'FOO',
//        ]);
//
//        $unary = $this->getMockBuilder(UnaryOperator::class)
//            ->setConstructorArgs([$constraint])
//            ->getMockForAbstractClass()
//        ;
//
//        $unary->expects(self::any())
//            ->method('operator')
//            ->willReturn('!')
//        ;
//        $unary->expects(self::any())
//            ->method('precedence')
//            ->willReturn(1)
//        ;
//
//        $regexp = '/is an object with properties identical to specified/';
//
//        self::expectException(ExpectationFailedException::class);
//        self::expectExceptionMessageMatches($regexp);
//
//        self::assertThat(new class() {
//        }, $unary);
//    }
}

// vim: syntax=php sw=4 ts=4 et:
