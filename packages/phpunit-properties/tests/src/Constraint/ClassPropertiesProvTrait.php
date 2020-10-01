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

use PHPUnit\Framework\Constraint\UnaryOperator;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
trait ClassPropertiesProvTrait
{
    // @codeCoverageIgnoreStart

    public static function provClassPropertiesIdenticalTo(): array
    {
        return [
            'ClassPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => [
                    'emptyString' => '',
                    'null'        => null,
                    'string123'   => '123',
                    'int321'      => 321,
                    'boolFalse'   => false,
                ],
                'actual' => get_class(new class() {
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
            'ClassPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => [
                    'emptyString' => null,
                    'null'        => '',
                    'string123'   => 123,
                    'int321'      => '321',
                    'boolFalse'   => 0,
                ],
                'actual' => get_class(new class() {
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
        $template = '%s is a class with properties equal to specified';

        $classes = [
            get_class(new class() {
                    public static $emptyString = '';
                    public static $null;
                    public static $string123 = '123';
                    public static $int321 = 321;
                    public static $boolFalse = false;
           }),
        ];

        return [
            'ClassPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => [
                    'emptyString' => 'foo',
                    'null'        => 1,
                    'string123'   => '321',
                    'int321'      => 123,
                    'boolFalse'   => true,
                ],
                'actual' => $classes[0],
                'message' => sprintf($template, $classes[0]),
            ],
        ];
    }

    public static function provClassPropertiesNotEqualToNonClass(): array
    {
        $template = '%s is a class with properties equal to specified';

        return [
            'ClassPropertiesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => 123,
                'message' => sprintf($template, 123)
            ],

            'ClassPropertiesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => 'arbitrary string',
                'message' => sprintf($template, sprintf("'%s'", addslashes('arbitrary string'))),
            ],

            'ClassPropertiesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => null,
                'message' => sprintf($template, 'null'),
            ],

            'ClassPropertiesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => ['foo' => 'FOO'],
                'message' => sprintf($template, 'array'),
            ],
        ];
    }

    public static function provClassPropertiesWithInvalidExpectationSpec(): array
    {
        $specs = [
            '3-int-keys' => [
                'array' => [
                    'a' => 'A', 0 => 'B', 2 => 'C', 7 => 'D', 'e' => 'E',
                ],
                'message'   => 'The array of expected properties contains 3 invalid key(s)',
            ],
        ];

        return [
            'ClassPropertiesProvTrait.php:'.__LINE__ => [
                'method' => 'classPropertiesIdenticalTo',
            ] + $specs['3-int-keys'],

            'ClassPropertiesProvTrait.php:'.__LINE__ => [
                'method' => 'classPropertiesEqualTo',
            ] + $specs['3-int-keys'],
        ];
    }

    // @codeCoverageIgnoreEnd
}

// vim: syntax=php sw=4 ts=4 et:
