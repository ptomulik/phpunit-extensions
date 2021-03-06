<?php declare(strict_types=1);

/*
 * This file is part of php-tailors/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPTailors\PHPUnit\Constraint;

use PHPTailors\PHPUnit\Inheritance\AbstractConstraint;
use PHPTailors\PHPUnit\Inheritance\ConstraintImplementationTrait;

/**
 * Constraint that accepts classes that extend given class.
 */
final class ExtendsClass extends AbstractConstraint
{
    use ConstraintImplementationTrait;

    /**
     * @var string
     */
    private static $verb = 'extends class';

    /**
     * @var string
     */
    private static $negatedVerb = 'does not extend class';

    /**
     * @var array
     * @psalm-var array{0:callable, 1:string}
     */
    private static $validation = ['class_exists', 'a class-string'];

    /**
     * @var callable
     * @psalm-var callable
     */
    private static $inheritance = 'class_parents';

    /**
     * @var array
     * @psalm-var array{0:callable}
     */
    private static $supports = ['class_exists'];
}

// vim: syntax=php sw=4 ts=4 et:
