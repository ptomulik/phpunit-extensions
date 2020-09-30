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

/**
 * @internal
 */
trait HasPregCapturesProvTrait
{
    // @codeCoverageIgnoreStart

    public static function provHasPregCaptures(): array
    {
        $defaultMessage = 'array does not have expected PCRE capture groups';
        $cases          = [
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [],
                'actual' => [],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => false],
                'actual' => [],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => false],
                'actual' => [0 => null],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => false],
                'actual' => [0 => [null, -1]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => false, 'foo' => false, 'bar' => false, 'gez' => false],
                'actual' => [],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [],
                'actual' => [0 => 'FOO'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => 'FOO'],
                'actual' => [0 => 'FOO'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true],
                'actual' => [0 => 'FOO'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false],
                'actual' => [0 => 'FOO'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'bar' => false],
                'actual' => [0 => 'FOO'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'gez' => false],
                'actual' => [0 => 'FOO'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false, 'bar' => false],
                'actual' => [0 => 'FOO'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false, 'gez' => false],
                'actual' => [0 => 'FOO'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false, 'bar' => false, 'gez' => false],
                'actual' => [0 => 'FOO'],
            ],

            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'bar' => true],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'gez' => false],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false, 'bar' => true],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false, 'gez' => false],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false, 'bar' => true, 'gez' => false],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => 'FOO BAR'],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['bar' => 'BAR'],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => 'FOO BAR', 'bar' => 'BAR'],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => 'FOO BAR', 'bar' => 'BAR', 'gez' => false],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => 'FOO BAR', 'bar' => 'BAR', 'gez' => false],
                'actual' => [0 => 'FOO BAR', 'bar' => 'BAR', 'gez' => null],
            ],

            //
            // PREG_OFFSET_CAPTURE
            //

            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'bar' => true],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'gez' => false],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false, 'bar' => true],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false, 'gez' => false],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'foo' => false, 'bar' => true, 'gez' => false],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => 'FOO BAR'],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['bar' => ['BAR', 4]],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['bar' => true],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => true, 'bar' => true],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => [0 => 'FOO BAR', 'bar' => ['BAR', 4], 'gez' => false],
                'actual' => [0 => 'FOO BAR', 'bar' => ['BAR', 4], 'gez' => [null, -1]],
            ],

            // other corner cases
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => null],
                'actual' => ['foo' => null],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => [null, -1]],
                'actual' => ['foo' => [null, -1]],
            ],
        ];

        foreach ($cases as &$case) {
            if (null === ($case['message'] ?? null)) {
                $case['message'] = $defaultMessage;
            }
        }

        return $cases;
    }

    /**
     * Suitable for both assertHasPregCaptures() and hasPregCaptures().
     */
    public function provNotHasPregCaptures(): array
    {
        $defaultMessage = 'array has expected PCRE capture groups';

        $cases = [
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => true],
                'actual' => [],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => true],
                'actual' => ['foo' => [null, -1]],
            ],

            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => 'FOO'],
                'actual' => [],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => 'FOO'],
                'actual' => ['bar' => 'FOO'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => 'FOO'],
                'actual' => ['foo' => [null, -1]],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => 'FOO'],
                'actual' => ['foo' => ['FOO', -1]],
            ],

            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => false],
                'actual' => ['foo' => 'FOO'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => 'BAR'],
                'actual' => ['foo' => 'FOO'],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => 'BAR'],
                'actual' => ['foo' => ['FOO', -1]],
            ],

            // other corner cases
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => null],
                'actual' => [],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => [null, -1]],
                'actual' => ['foo' => null],
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect' => ['foo' => [null, -1]],
                'actual' => [],
            ],
        ];

        foreach ($cases as &$case) {
            if (null === ($case['message'] ?? null)) {
                $case['message'] = $defaultMessage;
            }
        }

        return $cases;
    }

    /**
     * Suitable only for hasPregCaptures().
     */
    public function provNotHasPregCapturesNonArray(): array
    {
        return [
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => false],
                'actual'  => 'stuff',
                'message' => 'string has expected PCRE capture groups',
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => false],
                'actual'  => 123,
                'message' => sprintf('%s has expected PCRE capture groups', gettype(123)),
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => false],
                'actual'  => null,
                'message' => sprintf('%s has expected PCRE capture groups', gettype(null)),
            ],
            'HasPregCapturesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => false],
                'actual'  => new \stdClass(),
                'message' => sprintf('object stdClass has expected PCRE capture groups'),
            ],
        ];
    }

    // @codeCoverageIgnoreStop
}

// vim: syntax=php sw=4 ts=4 et:
