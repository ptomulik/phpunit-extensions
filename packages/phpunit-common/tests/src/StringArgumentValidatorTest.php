<?php declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit;

use PHPUnit\Framework\TestCase;

/**
 * @small
 * @covers \PHPFox\PHPUnit\StringArgumentValidator
 *
 * @internal This class is not covered by the backward compatibility promise
 */
final class StringArgumentValidatorTest extends TestCase
{
    public function testValidateSucceeds(): void
    {
        $validator = new StringArgumentValidator('is_numeric', 'a numeric string');
        self::assertNull($validator->validate(1, '123'));
    }

    public function testValidateThrowsInvalidArgumentException(): void
    {
        $message = sprintf('Argument #1 of %s() must be a numeric string, \'foo\' given.', __METHOD__);

        $validator = new StringArgumentValidator('is_numeric', 'a numeric string');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);

        $validator->validate(1, 'foo');
    }
}

// vim: syntax=php sw=4 ts=4 et:
