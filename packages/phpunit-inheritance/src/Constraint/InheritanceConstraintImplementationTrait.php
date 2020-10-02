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

use PHPFox\PHPUnit\InvalidArgumentException;
use PHPFox\PHPUnit\StringArgumentValidator;

/**
 * Constraint that accepts classes that extend given class.
 *
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 */
trait InheritanceConstraintImplementationTrait
{
    /**
     * @throws InvalidArgumentException
     *
     * @psalm-assert class-string $expected
     */
    public static function create(string $expected): self
    {
        self::getValidator()->validate(1, $expected);

        return new self($expected);
    }

    /**
     * Returns short description of what we examine, e.g. ``'impements interface'``.
     */
    protected function verb(): string
    {
        return self::$verb;
    }

    /**
     * Returns short negated description of what we examine, e.g. ``'does not impement interface'``.
     */
    protected function negatedVerb(): string
    {
        return self::$negatedVerb;
    }

    private static function getValidator(): StringArgumentValidator
    {
        return new StringArgumentValidator(...self::$validatorArgs);
    }
}

// vim: syntax=php sw=4 ts=4 et:
