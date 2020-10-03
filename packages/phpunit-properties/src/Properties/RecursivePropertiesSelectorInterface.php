<?php declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Properties;

/**
 * @internal
 */
interface RecursivePropertiesSelectorInterface
{
    /**
     * @param mixed $subject
     */
    public function selectProperties($subject): ActualPropertiesInterface;
}

// vim: syntax=php sw=4 ts=4 et:
