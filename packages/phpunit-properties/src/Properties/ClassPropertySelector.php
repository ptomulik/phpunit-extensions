<?php declare(strict_types=1);

/*
 * This file is part of php-tailors/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPTailors\PHPUnit\Properties;

use PHPTailors\PHPUnit\InvalidArgumentException;

/**
 * @internal This class is not covered by the backward compatibility promise
 * @psalm-internal PHPTailors\PHPUnit
 */
final class ClassPropertySelector extends AbstractPropertySelector
{
    /**
     * @psalm-assert-if-true class-string $subject
     *
     * @param mixed $subject
     */
    public function canSelectFrom($subject): bool
    {
        return is_string($subject) && class_exists($subject);
    }

    /**
     * Returns short description of subject type supported by this constraint.
     */
    public function subject(): string
    {
        return 'a class';
    }

    /**
     * @param mixed $subject
     * @param mixed $retval
     * @param-out mixed $retval
     * @psalm-assert class-string $subject
     * @psalm-assert-if-false !callable $subject::$method
     */
    protected function selectWithMethod($subject, string $method, &$retval = null): bool
    {
        self::assertClassString($subject, 1);

        if (!method_exists($subject, $method)) {
            return false;
        }
        /** @psalm-var mixed $retval */
        $retval = call_user_func([$subject, $method]);

        return true;
    }

    /**
     * @param mixed $subject
     * @param mixed $key
     * @param mixed $retval
     * @param-out mixed $retval
     * @psalm-param array-key $key
     * @psalm-assert class-string $subject
     *
     * @throws InvalidArgumentException
     */
    protected function selectWithAttribute($subject, $key, &$retval = null): bool
    {
        self::assertClassString($subject, 1);

        $key = (string) $key;
        if (!property_exists($subject, $key)) {
            return false;
        }
        /** @psalm-var mixed $retval */
        $retval = $subject::${$key};

        return true;
    }

    /**
     * @psalm-assert class-string $subject
     *
     * @param mixed $subject
     *
     * @throws InvalidArgumentException
     */
    private static function assertClassString($subject, int $argument, int $distance = 1): void
    {
        if (!is_string($subject) || !class_exists($subject)) {
            $provided = is_object($subject) ? 'an object '.get_class($subject) : gettype($subject);

            throw InvalidArgumentException::fromBackTrace($argument, 'a class', $provided, 1 + $distance);
        }
    }
}

// vim: syntax=php sw=4 ts=4 et:
