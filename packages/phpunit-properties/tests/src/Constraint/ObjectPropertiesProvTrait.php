<?php

declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Constraint;

use PHPFox\PHPUnit\Properties\EqualityComparator;
use PHPFox\PHPUnit\Properties\IdentityComparator;
use PHPFox\PHPUnit\Exception\InvalidArgumentException;

/**
 * @internal
 */
trait ObjectPropertiesProvTrait
{
    abstract public static function getComparatorClass(): string;

    abstract public static function getComparisonAdjective(string $comparator): string;

    // @codeCoverageIgnoreStart

    public static function provObjectPropertiesIdenticalTo(): array
    {
        $adjective = self::getComparisonAdjective(self::getComparatorClass());
        $template = '%s fails to be an object with properties '.$adjective.' specified';

        $esmith          = new class() {
            public $name = 'Emily';
            public $last = 'Smith';
            public $age  = 20;
            public $husband;
            public $family  = [];
            private $salary = 98;

            public function getSalary()
            {
                return $this->salary;
            }

            public function getDebit()
            {
                return -$this->salary;
            }

            public function marry($husband)
            {
                $this->husband  = $husband;
                $this->family[] = $husband;
            }
        };

        $jsmith          = new class() {
            public $name = 'John';
            public $last = 'Smith';
            public $age  = 21;
            public $wife;
            public $family  = [];
            private $salary = 123;

            public function getSalary()
            {
                return $this->salary;
            }

            public function getDebit()
            {
                return -$this->salary;
            }

            public function marry($wife)
            {
                $this->wife     = $wife;
                $this->family[] = $wife;
            }
        };

        $esmith->marry($jsmith);
        $jsmith->marry($esmith);

        $registry            = new class() {
            public $persons  = [];
            public $families = [];

            public function addFamily(string $key, array $persons)
            {
                $this->families[$key] = $persons;
                $this->persons        = array_merge($this->persons, $persons);
            }
        };

        $registry->addFamily('smith', [$esmith, $jsmith]);

        return [
            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => ['name' => 'John', 'last' => 'Smith', 'age' => 21, 'wife' => $esmith],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => [
                    'name' => 'John',
                    'last' => 'Smith',
                    'age'  => 21,
                    'wife' => $esmith,
                ],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => ['name' => 'John', 'last' => 'Smith', 'age' => 21],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => ['name' => 'John', 'last' => 'Smith'],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => ['age' => 21],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => ['age' => 21, 'getSalary()' => 123, 'getDebit()' => -123],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => [
                    'name' => 'John',
                    'last' => 'Smith',
                    'age'  => 21,
                    'wife' => ObjectPropertiesIdenticalTo::fromArray([
                        'name'        => 'Emily',
                        'last'        => 'Smith',
                        'age'         => 20,
                        'husband'     => $jsmith,
                        'getSalary()' => 98,
                    ]),
                ],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => [
                    'name' => 'John',
                    'last' => 'Smith',
                    'age'  => 21,
                    'wife' => ObjectPropertiesIdenticalTo::fromArray([
                        'name'    => 'Emily',
                        'last'    => 'Smith',
                        'age'     => 20,
                        'husband' => ObjectPropertiesIdenticalTo::fromArray([
                            'name'        => 'John',
                            'last'        => 'Smith',
                            'age'         => 21,
                            'getSalary()' => 123,
                        ]),
                        'getSalary()' => 98,
                    ]),
                ],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => [
                    'family' => [$esmith],
                ],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => [
                    'family' => [
                        ObjectPropertiesIdenticalTo::fromArray(['name' => 'Emily', 'last' => 'Smith']),
                    ],
                ],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => [
                    'persons' => [
                        ObjectPropertiesIdenticalTo::fromArray(['name' => 'Emily', 'last' => 'Smith']),
                        ObjectPropertiesIdenticalTo::fromArray(['name' => 'John', 'last' => 'Smith']),
                    ],
                    'families' => [
                        'smith' => [
                            ObjectPropertiesIdenticalTo::fromArray(['name' => 'Emily', 'last' => 'Smith']),
                            ObjectPropertiesIdenticalTo::fromArray(['name' => 'John', 'last' => 'Smith']),
                        ],
                    ],
                ],
                'actual' => $registry,
                'message' => sprintf($template, 'object '.get_class($registry)),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => [
                    'persons' => [
                        $esmith,
                        $jsmith,
                    ],
                    'families' => [
                        'smith' => [
                            $esmith,
                            $jsmith,
                        ],
                    ],
                ],
                'actual' => $registry,
                'message' => sprintf($template, 'object '.get_class($registry)),
            ],
        ];
    }

    public static function provObjectPropertiesEqualButNotIdenticalTo(): array
    {
        $comparator = self::getComparatorClass();
        $adjective = self::getComparisonAdjective($comparator);
        $verb = EqualityComparator::class === $comparator ? 'fails to be' : 'is';

        $template = '%s '.$verb.' an object with properties '.$adjective.' specified';

        $object                 = new class() {
            public $emptyString = '';
            public $null;
            public $string123 = '123';
            public $int321    = 321;
            public $boolFalse = false;
        };

        return [
            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect' => [
                    'emptyString' => null,
                    'null'        => '',
                    'string123'   => 123,
                    'int321'      => '321',
                    'boolFalse'   => 0,
                ],
                'actual' => $object,
                'message' => sprintf($template, 'object '.get_class($object)),
            ],
        ];
    }

    public static function provObjectPropertiesNotEqualTo(): array
    {
        $adjective = self::getComparisonAdjective(self::getComparatorClass());
        $template = '%s is an object with properties '.$adjective.' specified';

        $hbrown          = new class() {
            public $name = 'Helen';
            public $last = 'Brown';
            public $age  = 44;
        };

        $esmith          = new class() {
            public $name = 'Emily';
            public $last = 'Smith';
            public $age  = 20;
            public $husband;
            public $family  = [];
            private $salary = 98;

            public function getSalary()
            {
                return $this->salary;
            }

            public function getDebit()
            {
                return -$this->salary;
            }

            public function marry($husband)
            {
                $this->husband  = $husband;
                $this->family[] = $husband;
            }
        };

        $jsmith          = new class() {
            public $name = 'John';
            public $last = 'Smith';
            public $age  = 21;
            public $wife;
            public $family  = [];
            private $salary = 123;

            public function getSalary()
            {
                return $this->salary;
            }

            public function getDebit()
            {
                return -$this->salary;
            }

            public function marry($wife)
            {
                $this->wife     = $wife;
                $this->family[] = $wife;
            }
        };

        $esmith->marry($jsmith);
        $jsmith->marry($esmith);

        $registry            = new class() {
            public $persons  = [];
            public $families = [];

            public function addFamily(string $key, array $persons)
            {
                $this->families[$key] = $persons;
                $this->persons        = array_merge($this->persons, $persons);
            }
        };

        $registry->addFamily('smith', [$esmith, $jsmith]);

        return [
            'ObjectPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => ['name' => 'John', 'last' => 'Brown', 'age' => 21],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => ['name' => 'John', 'last' => 'Smith', 'wife' => null],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => ['name' => 'John', 'last' => 'Smith', 'wife' => 'Emily'],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => ['name' => 'John', 'last' => 'Smith', 'wife' => $hbrown],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => ['name' => 'John', 'last' => 'Brown'],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => ['age' => 19],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => ['age' => 21, 'getSalary()' => 1230],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => [
                    'name' => 'John',
                    'last' => 'Smith',
                    'age'  => 21,
                    'wife' => [
                        'name'    => 'Emily',
                        'last'    => 'Smith',
                        'age'     => 20,
                        'husband' => [
                            'name'        => 'John',
                            'last'        => 'Smith',
                            'age'         => 21,
                            'getSalary()' => 123,
                        ],
                        'getSalary()' => 98,
                    ],
                ],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => [
                    'family' => [
                        ['name' => 'Emily', 'last' => 'Smith'],
                    ],
                ],
                'actual' => $jsmith,
                'message' => sprintf($template, 'object '.get_class($jsmith)),
            ],

            'ObjectPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => [
                    'persons' => [
                        ['name' => 'Emily', 'last' => 'Smith'],
                        ['name' => 'John', 'last' => 'Smith'],
                    ],
                    'families' => [
                        'smith' => [
                            ['name' => 'Emily', 'last' => 'Smith'],
                            ['name' => 'John', 'last' => 'Smith'],
                        ],
                    ],
                ],
                'actual' => $registry,
                'message' => sprintf($template, 'object '.get_class($registry)),
            ],

            'ObjectPropertiesEqualToTraitTest.php:'.__LINE__ => [
                'expect' => [
                    'persons' => [
                        $esmith,
                        $jsmith,
                    ],
                    // the following should not match as the 'families' property is an array, not an object.
                    'families' => ObjectPropertiesIdenticalTo::fromArray([
                        'smith' => [
                            $esmith,
                            $jsmith,
                        ],
                    ]),
                ],
                'actual' => $registry,
                'message' => sprintf($template, 'object '.get_class($registry)),
            ],
        ];
    }

    public static function provObjectPropertiesNotEqualToNonObject(): array
    {
        $adjective = self::getComparisonAdjective(self::getComparatorClass());
        $template = '%s is an object with properties '.$adjective.' specified';

        return [
            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => 123,
                'message' => sprintf($template, 123),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => 'arbitrary string',
                'message' => sprintf($template, sprintf("'%s'", addslashes('arbitrary string'))),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => null,
                'message' => sprintf($template, 'null'),
            ],

            'ObjectPropertiesProvTrait.php:'.__LINE__ => [
                'expect'  => ['foo' => 'FOO'],
                'actual'  => ['foo' => 'FOO'],
                'message' => sprintf($template, 'array'),
            ],
        ];
    }

    // @codeCoverageIgnoreEnd
}

// vim: syntax=php sw=4 ts=4 et:
