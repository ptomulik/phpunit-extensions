<?php declare(strict_types=1);

namespace PHPFox\PHPUnit\Assert;

use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
final class AssertImplementsInterfaceTest extends TestCase
{
    public function testAssertImplementsInterface()
    {
        $this->assertImplementsInterface(\Throwable::class, \RuntimeException::class);
        $this->assertImplementsInterface(\Throwable::class, new \RuntimeException);
    }

    public function testAssertImplementsInterfaceFailure()
    {
        $this->assertImplementsInterface(\Throwable::class, self::class);
    }
}
