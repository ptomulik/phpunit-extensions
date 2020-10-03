<?php declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Properties;

interface ComparatorInterface
{
    /**
     * Compares two values.
     *
     * @param mixed $left
     * @param mixed $right
     */
    public function compare($left, $right): bool;

    /**
     * Returns an adjective that identifies this comparison operator.
     *
     * Shall return strings such as "equal to" (equality operator ``==``),
     * "identical to" (identity operator ``===``), etc..
     */
    public function adjective(): string;
}

// vim: syntax=php sw=4 ts=4 et:
