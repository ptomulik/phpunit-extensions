<?php declare(strict_types=1);

/*
 * This file is part of php-tailors/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPTailors\PHPUnit\Properties;

use PHPTailors\PHPUnit\ImplementsInterfaceTrait;
use PHPUnit\Framework\TestCase;

/**
 * @small
 * @covers \PHPTailors\PHPUnit\Properties\EqualityComparator
 *
 * @internal This class is not covered by the backward compatibility promise
 * @psalm-internal PHPTailors\PHPUnit
 */
final class EqualityComparatorTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function testImplementsComparatorInterface(): void
    {
        self::assertImplementsInterface(ComparatorInterface::class, EqualityComparator::class);
    }

    public static function provCompare(): array
    {
        return [
            'EqualityComparatorTest.php:'.__LINE__ => [
                'a', 'a', true,
            ],

            'EqualityComparatorTest.php:'.__LINE__ => [
                '123', 123, true,
            ],

            'EqualityComparatorTest.php:'.__LINE__ => [
                '', null, true,
            ],

            'EqualityComparatorTest.php:'.__LINE__ => [
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
        $comparator = new EqualityComparator();
        self::assertSame($expect, $comparator->compare($left, $right));
    }

    public function testAdjective(): void
    {
        $comparator = new EqualityComparator();
        self::assertSame('equal to', $comparator->adjective());
    }
}
// vim: syntax=php sw=4 ts=4 et:
