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
 * Constraint that accepts classes that extend given class.
 *
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 */
final class UsesTrait extends AbstractInheritanceConstraint
{
    use InheritanceConstraintImplementationTrait;

    private static $verb = 'uses trait';
    private static $negatedVerb = 'does not use trait';
    private static $validatorArgs = ['trait_exists', 'a trait-string'];

    /**
     * Returns an array of traits $class uses.
     */
    protected function inheritance(string $class): array
    {
        return class_uses($class);
    }

    /**
     * Checks if *$subject* may be used as an argument to inheritance().
     *
     * @psalm-assert-if-true class-string|trait-string $subject
     */
    protected function supports(string $subject): bool
    {
        return class_exists($subject) || trait_exists($subject);
    }
}

// vim: syntax=php sw=4 ts=4 et:
