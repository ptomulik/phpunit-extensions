<?php declare(strict_types=1);

final class AssertImplementsInterfaceTest extends \PHPUnit\Framework\TestCase
{
    use \PHPFox\PHPUnit\ImplementsInterfaceTrait;

    public function testAssertImplementsInterface()
    {
        $this->assertImplementsInterface(\Throwable::class, \RuntimeException::class);
        $this->assertImplementsInterface(\Throwable::class, new \RuntimeException());
    }

    public function testAssertImplementsInterfaceFailure()
    {
        $this->assertImplementsInterface(\Throwable::class, self::class);
    }
}
