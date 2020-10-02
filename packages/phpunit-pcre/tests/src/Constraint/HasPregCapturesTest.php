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

use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Constraint\HasPregCaptures
 * @covers \PHPFox\PHPUnit\Constraint\ProvHasPregCapturesTrait
 *
 * @internal
 */
final class HasPregCapturesTest extends TestCase
{
    use ProvHasPregCapturesTrait;

    /**
     * @dataProvider provHasPregCaptures
     *
     * @param mixed $actual
     */
    public function testHasPregCapturesSucceeds(array $expect, $actual): void
    {
        $constraint = HasPregCaptures::create($expect);
        self::assertThat($actual, $constraint);
    }

    /**
     * @dataProvider provNotHasPregCaptures
     * @dataProvider provNotHasPregCapturesNonArray
     *
     * @param mixed $actual
     */
    public function testHasPregCapturesFails(array $expected, $actual, string $message): void
    {
        $constraint = HasPregCaptures::create($expected);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage($message);

        $constraint->evaluate($actual);
    }

    /**
     * @dataProvider provNotHasPregCaptures
     * @dataProvider provNotHasPregCapturesNonArray
     *
     * @param mixed $actual
     */
    public function testNotHasPregCapturesSucceeds(array $expect, $actual): void
    {
        $constraint = new LogicalNot(HasPregCaptures::create($expect));
        self::assertThat($actual, $constraint);
    }

    /**
     * @dataProvider provHasPregCaptures
     *
     * @param mixed $actual
     */
    public function testNotHasPregCapturesFails(array $expect, $actual, string $message): void
    {
        $constraint = new LogicalNot(HasPregCaptures::create($expect));

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage($message);

        $constraint->evaluate($actual);
    }
}

// vim: syntax=php sw=4 ts=4 et:
