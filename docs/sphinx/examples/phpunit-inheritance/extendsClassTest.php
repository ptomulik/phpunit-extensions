<?php declare(strict_types=1);

namespace PHPFox\PHPUnit\Assert;

use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
final class ExtendsClassTest extends TestCase
{
    public function testExtendsClass()
    {
        $this->assertThat(\RuntimeException::class, $this->extendsClass(\Exception::class));
        $this->assertThat(new \RuntimeException, $this->extendsClass(\Exception::class));
    }

    public function testExtendsClassFailure()
    {
        $this->assertThat(self::class, $this->extendsClass(\Exception::class));
    }
}
