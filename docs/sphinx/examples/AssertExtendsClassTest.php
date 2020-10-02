<?php declare(strict_types=1);

final class AssertExtendsClassTest extends \PHPUnit\Framework\TestCase
{
    use \PHPFox\PHPUnit\ExtendsClassTrait;

    public function testAssertExtendsClass()
    {
        $this->assertExtendsClass(\Exception::class, \RuntimeException::class);
        $this->assertExtendsClass(\Exception::class, new \RuntimeException());
    }

    public function testAssertExtendsClassFailure()
    {
        $this->assertExtendsClass(\Exception::class, self::class);
    }
}
