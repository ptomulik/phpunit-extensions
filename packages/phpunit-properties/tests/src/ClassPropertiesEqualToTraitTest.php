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
}

// vim: syntax=php sw=4 ts=4 et:
