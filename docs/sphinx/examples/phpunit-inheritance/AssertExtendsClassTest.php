<?php declare(strict_types=1);

namespace PHPFox\PHPUnit\Assert;

use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
final class AssertExtendsClassTest extends TestCase
{
    public function testAssertExtendsClass()
    {
        $this->assertExtendsClass(\Exception::class, \RuntimeException::class);
        $this->assertExtendsClass(\Exception::class, new \RuntimeException);
    }

    public function testAssertExtendsClassFailure()
    {
        $this->assertExtendsClass(\Exception::class, self::class);
    }
}
