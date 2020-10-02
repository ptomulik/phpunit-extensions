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
final class UsesTrait extends AbstractConstraint
{
    use ConstraintImplementationTrait;

    private static $verb = 'uses trait';
    private static $negatedVerb = 'does not use trait';
    private static $validation = ['trait_exists', 'a trait-string'];
    private static $inheritance = 'class_uses';
    private static $supports = ['class_exists', 'trait_exists'];
}

// vim: syntax=php sw=4 ts=4 et:
