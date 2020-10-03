<?php declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Inheritance;

use PHPFox\PHPUnit\StringArgumentValidator;

/**
 * Implementation of an inheritance constraint class.
 *
 * The trait expects the following static attributes to be defined::
 *
 *      private static $verb;           // for example $verb = 'extends class';
 *      private static $negatedVerb;    // for example $negatedVerb = 'does not extend class';
 *      private static $validation;     // for example $validation = ['class_exists', 'a class-string'];
 *      private static $inheritance;    // for example $validation = 'class_parents';
 *      private static $supports;       // for example $supports = ['class_exists'];
 *
 * @internal
 */
trait ConstraintImplementationTrait
{
    /**
     * @throws \PHPFox\PHPUnit\InvalidArgumentException
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

    protected function inheritance(string $class): array
    {
        $value = (self::$inheritance)($class);
        self::assertIsArray($value);

        return $value;
    }

    /**
     * Checks if *$subject* may be used as an argument to inheritance().
     */
    protected function supports(string $subject): bool
    {
        foreach (self::$supports as $function) {
            if (call_user_func($function, $subject)) {
                return true;
            }
        }

        return false;
    }

    private static function getValidator(): StringArgumentValidator
    {
        return new StringArgumentValidator(self::$validation[0], self::$validation[1]);
    }

    /**
     * @param mixed $value
     */
    private static function assertIsArray($value): void
    {
        if (!is_array($value)) {
            throw new \Exception('function returned false');
        }
    }
}

// vim: syntax=php sw=4 ts=4 et:
