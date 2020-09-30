<?php declare(strict_types=1);

final class implementsInterfaceTest extends \PHPUnit\Framework\TestCase
{
    use \PHPFox\PHPUnit\Assertions\InheritanceAssertionsTrait;

    public function testImplementsInterface()
    {
        $this->assertThat(\RuntimeException::class, $this->implementsInterface(\Throwable::class));
        $this->assertThat(new \RuntimeException(), $this->implementsInterface(\Throwable::class));
    }

    public function testImplementsInterfaceFailure()
    {
        $this->assertThat(self::class, $this->implementsInterface(\Throwable::class));
    }
}
