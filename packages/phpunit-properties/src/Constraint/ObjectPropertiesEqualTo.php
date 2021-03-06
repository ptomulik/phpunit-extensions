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
use PHPTailors\PHPUnit\Properties\EqualityComparator;
use PHPTailors\PHPUnit\Properties\ObjectPropertySelector;
use PHPTailors\PHPUnit\Properties\PropertySelectorInterface;

/**
 * Constraint that accepts objects having properties equal to specified ones.
 *
 * Compares only properties present in the array of expectations. A property is
 * defined as either an attribute value or a value returned by object's method
 * callable without arguments. The ``==`` operator (equality) is used for
 * comparison.
 *
 *
 * Any key in *$expected* array ending with ``"()"`` is considered to be a
 * method that returns property value.
 *
 *      // ...
 *      $matcher = ObjectPropertiesEqualTo::create([
 *          'getName()' => 'John', 'age' => '21'
 *      ]);
 *
 *      self::assertThat(new class {
 *          public static $age = 21;
 *          public static getName(): string {
 *              return 'John';
 *          }
 *      }, $matcher);
 */
final class ObjectPropertiesEqualTo extends AbstractConstraint
{
    use ConstraintImplementationTrait;

    /**
     * Creates instance of EqualityComparator.
     */
    protected static function makeComparator(): ComparatorInterface
    {
        return new EqualityComparator();
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
