<?php declare(strict_types=1);

final class AssertObjectPropertiesEqualToTest extends PHPUnit\Framework\TestCase
{
    use \PHPFox\PHPUnit\PropertiesAssertionsTrait;

    public $attribute = 123;

    public function getValue()
    {
        return 321;
    }

    public function testSuccess()
    {
        // assert that:
        $this->assertObjectPropertiesEqualTo([
            'attribute'  => '123',     // - $this->attribute equals '123' (ok)
            'getValue()' => '321',     // - $this->getValue() equals '321' (ok)
        ], $this);
    }

    public function testFailure()
    {
        // assert that:
        $this->assertObjectPropertiesEqualTo([
            'attribute'  => '123',   // - $this->attribute equals '123' (ok),
            'getValue()' => null,    // - $this->getValue() is 321, not equals null (fail)
        ], $this);
    }
}
