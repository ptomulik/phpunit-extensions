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

use PHPFox\PHPUnit\Exception\InvalidArgumentException;
use PHPFox\PHPUnit\Properties\ComparatorInterface;
use PHPFox\PHPUnit\Properties\ExpectedProperties;
use PHPFox\PHPUnit\Properties\PropertySelectorInterface;
use PHPFox\PHPUnit\Properties\RecursivePropertiesUnwrapper;
use PHPFox\PHPUnit\Properties\RecursivePropertiesUnwrapperInterface;

trait NamedPropertiesComparatorTrait
{
    public static function fromArray(array $expected, RecursivePropertiesUnwrapperInterface $unwrapper = null): self
    {
        self::assertStringKeysOnly($expected, 1);

        $comparator = self::makeComparator();
        $selector = self::makePropertySelector();

        if (null === $unwrapper) {
            $unwrapper = new RecursivePropertiesUnwrapper();
        }

        return new self($comparator, new ExpectedProperties($selector, $expected), $unwrapper);
    }

    /**
     * Creates instance of ClassPropertySelector.
     */
    abstract protected static function makePropertySelector(): PropertySelectorInterface;

    /**
     * Creates instance of EqualityComparator.
     */
    abstract protected static function makeComparator(): ComparatorInterface;

    /**
     * @psalm-assert array<string, mixed> $array
     *
     * @throws InvalidArgumentException
     */
    private static function assertStringKeysOnly(array $array, int $argument, int $depth = 1): void
    {
        $valid = array_filter($array, 'is_string', ARRAY_FILTER_USE_KEY);
        if (($count = count($array) - count($valid)) > 0) {
            throw InvalidArgumentException::fromBackTrace(
                1,
                'an associative array with string keys',
                sprintf('an array with %d non-string keys', $count),
                1 + $depth
            );
        }
    }
}

// vim: syntax=php sw=4 ts=4 et:
