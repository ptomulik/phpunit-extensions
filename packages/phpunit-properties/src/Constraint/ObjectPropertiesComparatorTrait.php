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

use PHPFox\PHPUnit\Properties\ObjectPropertySelector;
use PHPFox\PHPUnit\Properties\PropertySelectorInterface;

trait ObjectPropertiesComparatorTrait
{
//    /**
//     * Returns short description of subject type supported by this constraint.
//     */
//    public function subject(): string
//    {
//        return 'an object';
//    }

    /**
     * Creates instance of ObjectPropertySelector.
     */
    protected static function makePropertySelector(): PropertySelectorInterface
    {
        return new ObjectPropertySelector();
    }
}

// vim: syntax=php sw=4 ts=4 et:
