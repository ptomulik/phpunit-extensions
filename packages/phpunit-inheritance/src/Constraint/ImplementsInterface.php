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
 * Constraint that accepts classes that implement given interface.
 *
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 */
final class ImplementsInterface extends AbstractInheritanceConstraint
{
    use InheritanceConstraintImplementationTrait;

    private static $verb = 'implements interface';
    private static $negatedVerb = 'does not implement interface';
    private static $validatorArgs = ['interface_exists', 'an interface-string'];

    /**
     * Returns an array of interfaces $class implements.
     */
    protected function inheritance(string $class): array
    {
        return class_implements($class);
    }

    /**
     * Checks if *$subject* may be used as an argument to inheritance().
     *
     * @psalm-assert-if-true class-string $subject
     */
    protected function supports(string $subject): bool
    {
        return class_exists($subject) || interface_exists($subject);
    }
}

// vim: syntax=php sw=4 ts=4 et:
