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

use PHPFox\PHPUnit\Properties\ComparatorInterface;
use PHPFox\PHPUnit\Properties\EqualityComparator;

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
 *      $matcher = ObjectPropertiesEqualTo::fromArray([
 *          'getName()' => 'John', 'age' => '21'
 *      ]);
 *
 *      self::assertThat(new class {
 *          public static $age = 21;
 *          public static getName(): string {
 *              return 'John';
 *          }
 *      }, $matcher);
 *
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 */
final class ObjectPropertiesEqualTo extends AbstractPropertiesConstraint
{
    use NamedPropertiesComparatorTrait;
    use ObjectPropertiesComparatorTrait;

    /**
     * Creates instance of EqualityComparator.
     */
    protected static function makeComparator(): ComparatorInterface
    {
        return new EqualityComparator();
    }
}

// vim: syntax=php sw=4 ts=4 et:
