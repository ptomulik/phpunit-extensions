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
    private static $validation = ['interface_exists', 'an interface-string'];
    private static $inheritance = 'class_implements';
    private static $supports = ['class_exists', 'interface_exists'];
}

// vim: syntax=php sw=4 ts=4 et:
