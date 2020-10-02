<?php declare(strict_types=1);

final class AssertObjectPropertiesIdenticalToTest extends \PHPUnit\Framework\TestCase
{
    use \PHPFox\PHPUnit\ObjectPropertiesIdenticalToTrait;

    public $attribute = 123;

    public function getValue()
    {
        return 321;
    }

    public function testSuccess()
    {
        // assert that:
        $this->assertObjectPropertiesIdenticalTo([
            'attribute'  => 123,     // - $this->attribute is 123 (ok)
            'getValue()' => 321,     // - $this->getValue() is 321 (ok)
        ], $this);
    }

    public function testFailure()
    {
        // assert that:
        $this->assertObjectPropertiesIdenticalTo([
            'attribute'  => '123',   // - $this->attribute is 123, not '123' (fail),
            'getValue()' => null,    // - $this->getValue() is 321, not null (fail)
        ], $this);
    }
}
