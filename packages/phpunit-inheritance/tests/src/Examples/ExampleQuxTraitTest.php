<?php

/*
 * This file is part of Korowai framework.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

declare(strict_types=1);

namespace PHPFox\PHPUnit\Examples;

use PHPFox\PHPUnit\Examples\ExampleQuxTrait;
use PHPFox\PHPUnit\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Examples\ExampleQuxTrait
 *
 * @internal
 */
final class ExampleQuxTraitTest extends TestCase
{
    public function getTestObject()
    {
        return new class() {
            use ExampleQuxTrait;
        };
    }

    public function testSetQux(): void
    {
        $object = $this->getTestObject();
        $this->assertNull($object->getQux());
        $object->setQux('QUX');
        $this->assertSame('QUX', $object->getQux());

        $object->qux = 'qUx';
        $this->assertSame('qUx', $object->getQux());
    }
}

// vim: syntax=php sw=4 ts=4 et:
