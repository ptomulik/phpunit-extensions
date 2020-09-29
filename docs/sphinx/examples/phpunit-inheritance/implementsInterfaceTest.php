<?php declare(strict_types=1);

namespace PHPFox\PHPUnit\Assert;

use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
final class ImplementsInterfaceTest extends TestCase
{
    public function testImplementsInterface()
    {
        $this->assertThat(\RuntimeException::class, $this->implementsInterface(\Throwable::class));
        $this->assertThat(new \RuntimeException, $this->implementsInterface(\Throwable::class));
    }

    public function testImplementsInterfaceFailure()
    {
        $this->assertThat(self::class, $this->implementsInterface(\Throwable::class));
    }
}
