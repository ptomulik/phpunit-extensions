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

use PHPFox\PHPUnit\Inheritance\AbstractConstraint;
use PHPFox\PHPUnit\Inheritance\ConstraintImplementationTrait;

/**
 * Constraint that accepts classes that extend given class.
 */
final class ExtendsClass extends AbstractConstraint
{
    use ConstraintImplementationTrait;

    private static $verb = 'extends class';
    private static $negatedVerb = 'does not extend class';
    private static $validation = ['class_exists', 'a class-string'];
    private static $inheritance = 'class_parents';
    private static $supports = ['class_exists'];
}

// vim: syntax=php sw=4 ts=4 et:
