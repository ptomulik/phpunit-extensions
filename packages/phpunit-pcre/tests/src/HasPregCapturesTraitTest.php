<?php declare(strict_types=1);

/*
 * This file is part of php-tailors/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPTailors\PHPUnit;

use PHPTailors\PHPUnit\Constraint\ProvHasPregCapturesTrait;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @small
 * @covers \PHPTailors\PHPUnit\Constraint\ProvHasPregCapturesTrait
 * @covers \PHPTailors\PHPUnit\HasPregCapturesTrait
 *
 * @internal This class is not covered by the backward compatibility promise
 * @psalm-internal PHPTailors\PHPUnit
 */
final class HasPregCapturesTraitTest extends TestCase
{
    use HasPregCapturesTrait;
    use ProvHasPregCapturesTrait;

    /**
     * @dataProvider provHasPregCaptures
     *
     * @param mixed $actual
     */
    public function testAssertHasPregCapturesSucceeds(array $expect, $actual): void
    {
        self::assertHasPregCaptures($expect, $actual);
    }

    /**
     * @dataProvider provNotHasPregCaptures
     *
     * @param mixed $actual
     */
    public function testAssertHasPregCapturesFails(array $expect, $actual, string $message): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(sprintf('Failed asserting that %s.', $message));

        self::assertHasPregCaptures($expect, $actual);
    }

    /**
     * @dataProvider provNotHasPregCaptures
     *
     * @param mixed $actual
     */
    public function testAssertNotHasPregCaptureSucceeds(array $expect, $actual): void
    {
        self::assertNotHasPregCaptures($expect, $actual);
    }

    /**
     * @dataProvider provHasPregCaptures
     *
     * @param mixed $actual
     */
    public function testAssertNotHasPregCaptureFails(array $expect, $actual, string $message): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(sprintf('Failed asserting that %s.', $message));
        self::assertNotHasPregCaptures($expect, $actual);
    }

    /**
     * @dataProvider provHasPregCaptures
     *
     * @param mixed $actual
     */
    public function testHasPregCapturesSucceeds(array $expect, $actual): void
    {
        self::assertThat($actual, self::hasPregCaptures($expect));
    }

    /**
     * @dataProvider provNotHasPregCaptures
     * @dataProvider provNotHasPregCapturesNonArray
     *
     * @param mixed $actual
     */
    public function testHasPregCapturesFails(array $expect, $actual, string $message): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(sprintf('Failed asserting that %s.', $message));

        self::assertThat($actual, self::hasPregCaptures($expect));
    }
}

// vim: syntax=php sw=4 ts=4 et:
