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

use PHPFox\PHPUnit\Properties\EqualityComparator;

/**
 * @internal
 */
trait ProvClassPropertiesTrait
{
    abstract public static function getComparatorClass(): string;

    abstract public static function getComparisonAdjective(string $comparator): string;

    // @codeCoverageIgnoreStart

    public static function provClassPropertiesIdenticalTo(): array
    {
        $adjective = self::getComparisonAdjective(self::getComparatorClass());
        $template = '%s fails to be a class with properties '.$adjective.' specified';

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
            'ProvClassPropertiesTrait.php:'.__LINE__ => [
                'expect' => [
                    'emptyString' => '',
                    'null'        => null,
                    'string123'   => '123',
                    'int321'      => 321,
                    'boolFalse'   => false,
                ],
                'actual'  => $classes[0],
                'message' => sprintf($template, $classes[0]),
            ],
        ];
    }

    public static function provClassPropertiesEqualButNotIdenticalTo(): array
    {
        $comparator = self::getComparatorClass();
        $adjective = self::getComparisonAdjective($comparator);
        $verb = EqualityComparator::class === $comparator ? 'fails to be' : 'is';

        $template = '%s '.$verb.' a class with properties '.$adjective.' specified';

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
            'ProvClassPropertiesTrait.php:'.__LINE__ => [
                'expect' => [
                    'emptyString' => null,
                    'null'        => '',
                    'string123'   => 123,
                    'int321'      => '321',
                    'boolFalse'   => 0,
                ],
                'actual'  => $classes[0],
                'message' => sprintf($template, $classes[0]),
            ],
        ];
    }

    public static function provClassPropertiesNotEqualTo(): array
    {
        $adjective = self::getComparisonAdjective(self::getComparatorClass());
        $template = '%s is a class with properties '.$adjective.' specified';

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
            'ProvClassPropertiesTrait.php:'.__LINE__ => [
                'expect' => [
                    'emptyString' => 'foo',
                    'null'        => 1,
                    'string123'   => '321',
                    'int321'      => 123,
                    'boolFalse'   => true,
                ],
                'actual'  => $classes[0],
                'message' => sprintf($template, $classes[0]),
            ],
        ];
    }

    public static function provClassPropertiesNotEqualToNonClass(): array
    {
        $adjective = self::getComparisonAdjective(self::getComparatorClass());
        $template = '%s is a class with properties '.$adjective.' specified';

        return [
            'ProvClassPropertiesTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => 123,
                'message' => sprintf($template, 123),
            ],

            'ProvClassPropertiesTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => 'arbitrary string',
                'message' => sprintf($template, sprintf("'%s'", addslashes('arbitrary string'))),
            ],

            'ProvClassPropertiesTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => null,
                'message' => sprintf($template, 'null'),
            ],

            'ProvClassPropertiesTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => ['foo' => 'FOO'],
                'message' => sprintf($template, 'array'),
            ],
        ];
    }

    // @codeCoverageIgnoreEnd
}

// vim: syntax=php sw=4 ts=4 et:
