<?php declare(strict_types=1);

/*
 * This file is part of php-tailors/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPTailors\PHPUnit\Constraint;

use PHPTailors\PHPUnit\Properties\AbstractConstraint;
use PHPTailors\PHPUnit\Properties\ComparatorInterface;
use PHPTailors\PHPUnit\Properties\ConstraintImplementationTrait;
use PHPTailors\PHPUnit\Properties\IdentityComparator;
use PHPTailors\PHPUnit\Properties\ObjectPropertySelector;
use PHPTailors\PHPUnit\Properties\PropertySelectorInterface;

/**
 * Constraint that accepts objects having properties identical to specified ones.
 *
 * Compares only properties present in the array of expectations. A property is
 * defined as either an attribute value or a value returned by object's method
 * callable without arguments. The ``===`` operator (identity) is used for
 * comparison.
 *
 *
 * Any key in *$expected* array ending with ``"()"`` is considered to be a
 * method that returns property value.
 *
 *      // ...
 *      $matcher = ObjectPropertiesIdenticalTo::create([
 *          'getName()' => 'John', 'age' => 21
 *      ]);
 *
 *      self::assertThat(new class {
 *          public static $age = 21;
 *          public static getName(): string {
 *              return 'John';
 *          }
 *      }, $matcher);
 */
final class ObjectPropertiesIdenticalTo extends AbstractConstraint
{
    use ConstraintImplementationTrait;

    /**
     * Creates instance of IdentityComparator.
     */
    protected static function makeComparator(): ComparatorInterface
    {
        return new IdentityComparator();
    }

    /**
     * Creates instance of ObjectPropertySelector.
     */
    protected static function makePropertySelector(): PropertySelectorInterface
    {
        return new ObjectPropertySelector();
    }
}

// vim: syntax=php sw=4 ts=4 et:
