<?php declare(strict_types=1);

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
 * Constraint that accepts classes that implement given interface.
 */
final class ImplementsInterface extends AbstractConstraint
{
    use ConstraintImplementationTrait;

    /**
     * @var string
     */
    private static $verb = 'implements interface';

    /**
     * @var string
     */
    private static $negatedVerb = 'does not implement interface';

    /**
     * @var array
     * @psalm-var array{0:callable, 1:string}
     */
    private static $validation = ['interface_exists', 'an interface-string'];

    /**
     * @var callable
     * @psalm-var callable
     */
    private static $inheritance = 'class_implements';

    /**
     * @var array
     * @psalm-var array{0:callable, 1:callable}
     */
    private static $supports = ['class_exists', 'interface_exists'];
}

// vim: syntax=php sw=4 ts=4 et:
