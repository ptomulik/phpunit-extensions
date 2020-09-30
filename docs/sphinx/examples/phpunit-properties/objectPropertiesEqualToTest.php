<?php declare(strict_types=1);

final class objectPropertiesEqualToTest extends \PHPUnit\Framework\TestCase
{
    use \PHPFox\PHPUnit\Assertions\PropertiesAssertionsTrait;

    public $attribute = 123;

    public function getValue()
    {
        return 321;
    }

    public function testSuccess()
    {
        // assert that:
        $this->assertThat($this, $this->objectPropertiesEqualTo([
            'attribute'  => '123', // - $this->attribute is 123, equals '123' (ok)
            'getValue()' => 321,    // - $this->getValue() is 321 (ok)
        ]));
    }

    public function testFailure()
    {
        // assert that:
        $this->assertThat($this, $this->objectPropertiesEqualTo([
            'attribute'  => '123',   // - $this->attribute is 123, equals '123' (ok)
            'getValue()' => null,     // - $this->getValue() is 321, not equals null (fail)
        ]));
    }
}
