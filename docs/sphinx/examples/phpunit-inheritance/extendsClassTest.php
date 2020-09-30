<?php declare(strict_types=1);

final class extendsClassTest extends \PHPUnit\Framework\TestCase
{
    use \PHPFox\PHPUnit\Assertions\InheritanceAssertionsTrait;

    public function testExtendsClass()
    {
        $this->assertThat(\RuntimeException::class, $this->extendsClass(\Exception::class));
        $this->assertThat(new \RuntimeException(), $this->extendsClass(\Exception::class));
    }

    public function testExtendsClassFailure()
    {
        $this->assertThat(self::class, $this->extendsClass(\Exception::class));
    }
}
