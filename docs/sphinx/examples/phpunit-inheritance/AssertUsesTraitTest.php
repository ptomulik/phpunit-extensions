<?php declare(strict_types=1);

trait ExampleTrait
{
}

final class AssertUsesTraitTest extends \PHPUnit\Framework\TestCase
{
    use \PHPFox\PHPUnit\InheritanceAssertionsTrait;
    use ExampleTrait;

    public function testAssertUsesTrait()
    {
        $this->assertUsesTrait(ExampleTrait::class, self::class);
        $this->assertUsesTrait(ExampleTrait::class, $this);
    }

    public function testAssertUsesTraitFailure()
    {
        $this->assertUsesTrait(ExampleTrait::class, \RuntimeException::class);
    }
}
