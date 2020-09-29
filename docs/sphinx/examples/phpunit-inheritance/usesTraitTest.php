<?php declare(strict_types=1);

namespace PHPFox\PHPUnit\Assert;

use PHPUnit\Framework\TestCase;

trait ExampleTrait
{
}

/**
 * @coversNothing
 */
final class UsesTraitTest extends TestCase
{
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
