<?php

declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Properties;

use PHPFox\PHPUnit\ImplementsInterfaceTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Properties\IdentityComparator
 *
 * @internal
 */
final class IdentityComparatorTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function testImplementsComparatorInterface(): void
    {
        self::assertImplementsInterface(ComparatorInterface::class, IdentityComparator::class);
    }

    public static function provCompare(): array
    {
        return [
            'IdentityComparatorTest.php:'.__LINE__ => [
                'a', 'a', true,
            ],

            'IdentityComparatorTest.php:'.__LINE__ => [
                '123', 123, false,
            ],

            'IdentityComparatorTest.php:'.__LINE__ => [
                '', null, false,
            ],

            'IdentityComparatorTest.php:'.__LINE__ => [
                'a', 'b', false,
            ],
        ];
    }

    /**
     * @dataProvider provCompare
     *
     * @param mixed $left
     * @param mixed $right
     */
    public function testCompare($left, $right, bool $expect): void
    {
        $comparator = new IdentityComparator();
        self::assertSame($expect, $comparator->compare($left, $right));
    }

    public function testAdjective(): void
    {
        $comparator = new IdentityComparator();
        self::assertSame('identical to', $comparator->adjective());
    }
}
// vim: syntax=php sw=4 ts=4 et:
