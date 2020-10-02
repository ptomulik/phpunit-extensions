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
final class ExtendsClass extends AbstractInheritanceConstraint
{
    use InheritanceConstraintImplementationTrait;

    private static $verb = 'extends class';
    private static $negatedVerb = 'does not extend class';
    private static $validatorArgs = ['class_exists', 'a class-string'];

    /**
     * Returns an array of classes $class extends.
     */
    protected function inheritance(string $class): array
    {
        return class_parents($class);
    }

    /**
     * Checks if *$subject* may be used as an argument to inheritance().
     *
     * @psalm-assert-if-true class-string $subject
     */
    protected function supports(string $subject): bool
    {
        return class_exists($subject);
    }
}

// vim: syntax=php sw=4 ts=4 et:
