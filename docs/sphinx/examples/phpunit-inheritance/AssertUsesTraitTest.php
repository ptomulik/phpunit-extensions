<?php declare(strict_types=1);

namespace PHPFox\PHPUnit\Assert;

use PHPUnit\Framework\TestCase;

trait ExampleTrait
{
}

/**
 * @coversNothing
 */
final class AssertUsesTraitTest extends TestCase
{
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
