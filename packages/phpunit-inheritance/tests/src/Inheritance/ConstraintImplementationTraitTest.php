<?php declare(strict_types=1);

/*
 * This file is part of php-tailors/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPTailors\PHPUnit\Inheritance;

use PHPTailors\PHPUnit\InvalidReturnValueException;
use PHPUnit\Framework\TestCase;

/**
 * @small
 * @covers \PHPTailors\PHPUnit\Inheritance\ConstraintImplementationTrait
 *
 * @internal This class is not covered by the backward compatibility promise
 * @psalm-internal PHPTailors\PHPUnit
 */
final class ConstraintImplementationTraitTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testInheritanceThrowsInvalidReturnValueException(): void
    {
        $constraint = FaultyConstraintImplementation::create('stdClass');

        $this->expectException(InvalidReturnValueException::class);
        $this->expectExceptionMessage(sprintf(
            'Return value of %s::%s() must be of the type array, %s returned',
            FaultyConstraintImplementation::class,
            '$inheritance',
            gettype(0)
        ));

        $constraint->inheritance('');
    }
}
