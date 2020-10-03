<?php declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit;

use PHPFox\PHPUnit\Constraint\ProvObjectPropertiesTrait;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \PHPFox\PHPUnit\ObjectPropertiesEqualToTrait
 * @small
 *
 * @internal
 */
final class ObjectPropertiesEqualToTraitTest extends TestCase
{
    use ObjectPropertiesEqualToTrait;
    use ProvObjectPropertiesTrait;

    /**
     * @dataProvider provObjectPropertiesIdenticalTo
     * @dataProvider provObjectPropertiesEqualButNotIdenticalTo
     */
    public function testObjectPropertiesEqualTo(array $expect, object $object)
    {
        self::assertThat($object, self::objectPropertiesEqualTo($expect));
    }

    /**
     * @dataProvider provObjectPropertiesNotEqualTo
     */
    public function testLogicalNotObjectPropertiesEqualTo(array $expect, object $object)
    {
        self::assertThat($object, self::logicalNot(self::objectPropertiesEqualTo($expect)));
    }

    /**
     * @dataProvider provObjectPropertiesIdenticalTo
     * @dataProvider provObjectPropertiesEqualButNotIdenticalTo
     */
    public function testAssertObjectPropertiesEqualTo(array $expect, object $object)
    {
        self::assertObjectPropertiesEqualTo($expect, $object);
    }

    /**
     * @dataProvider provObjectPropertiesNotEqualTo
     */
    public function testAssertObjectPropertiesEqualToFails(array $expect, object $object)
    {
        $regexp = '/^Lorem ipsum.\n'.
            'Failed asserting that object class\@.+ is an object '.
            'with properties equal to specified./';
        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessageMatches($regexp);

        self::assertObjectPropertiesEqualTo($expect, $object, 'Lorem ipsum.');
    }

    /**
     * @dataProvider provObjectPropertiesNotEqualTo
     */
    public function testAssertNotObjectPropertiesEqualTo(array $expect, object $object)
    {
        self::assertNotObjectPropertiesEqualTo($expect, $object);
    }

    /**
     * @dataProvider provObjectPropertiesIdenticalTo
     * @dataProvider provObjectPropertiesEqualButNotIdenticalTo
     */
    public function testAssertNotObjectPropertiesEqualToFails(array $expect, object $object)
    {
        $regexp = '/^Lorem ipsum.\n'.
            'Failed asserting that object class@.+ fails to be an object '.
            'with properties equal to specified./';
        self::expectException(ExpectationFailedException::class);
        self::expectExceptionMessageMatches($regexp);

        self::assertNotObjectPropertiesEqualTo($expect, $object, 'Lorem ipsum.');
    }
}

// vim: syntax=php sw=4 ts=4 et:
