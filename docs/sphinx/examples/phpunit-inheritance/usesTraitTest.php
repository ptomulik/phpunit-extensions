<?php declare(strict_types=1);

trait ExampleTrait
{
}

final class UsesTraitTest extends \PHPUnit\Framework\TestCase
{
    use \PHPFox\PHPUnit\UsesTraitTrait;
    use ExampleTrait;

    public function testUsesTrait()
    {
        $this->assertThat(self::class, $this->usesTrait(ExampleTrait::class));
        $this->assertThat($this, $this->usesTrait(ExampleTrait::class));
    }

    public function testUsesTraitFailure()
    {
        $this->assertThat(\RuntimeException::class, $this->usesTrait(ExampleTrait::class));
    }
}
