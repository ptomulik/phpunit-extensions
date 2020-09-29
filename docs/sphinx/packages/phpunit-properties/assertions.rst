.. _phpunit-properties.assertions:

Assertions
==========

This section lists the various assertion methods that are available.

.. _phpunit-properties.assertions.assertClassPropertiesEqualTo:

assertClassPropertiesEqualTo()
------------------------------

Synopsis:

.. code:: php

  function assertClassPropertiesEqualTo(array $expected, string $class[, string $message = ''])

Reports an error identified by ``$message`` if properties of ``$class`` are not
equal to ``$expected`` ones (tested with ``==`` operator).
A property is either a static attribute value or a value returned by class's
static method that is callable without arguments. The method compares only
properties described in ``$expected``, so ``$expected = []`` accepts any
existing ``$class``. If ``$class`` does not exists, the constraint fails as
well.

The arguments are:

- ``$expected`` - an associative array with property names as keys and their
  expected values as values, if a key ends with ``"()"``, then the property is
  assumed to be a method, for example ``$expected = ['foo()' => 'F']`` requires
  method ``foo()`` to return ``'F'``,
- ``$class`` - name of the class to be examined,
- ``$message`` - optional failure message,

The method

.. code:: php

  function assertNotClassPropertiesEqualTo(array $expected, string $class[, string $message = ''])

is the inverse of this.

.. literalinclude:: ../../examples/phpunit-properties/AssertClassPropertiesEqualToTest.php
   :linenos:
   :caption: Usage of assertClassPropertiesEqualTo()
   :name: phpunit-properties.assertions.assertClassPropertiesEqualTo.example

.. literalinclude:: ../../examples/phpunit-properties/AssertClassPropertiesEqualToTest.stdout
  :linenos:
  :language: none

.. _phpunit-properties.assertions.assertClassPropertiesIdenticalTo:

assertClassPropertiesIdenticalTo()
----------------------------------

Synopsis:

.. code:: php

  function assertClassPropertiesIdenticalTo(array $expected, string $class[, string $message = ''])

Reports an error identified by ``$message`` if properties of ``$class``'s are
not identical to ``$expected`` ones (tested with ``===`` operator).
A property is either a static attribute value or a value returned by
``$class``'s static method that is callable without arguments. The method
compares only properties described in ``$expected``, so ``$expected = []``
accepts any existing ``$class``. If ``$class`` does not exist, the constraint
fails as well.

The arguments are:

- ``$expected`` - an associative array with property names as keys and their
  expected values as values, if a key ends with ``"()"``, then the property is
  assumed to be a method, for example ``$expected = ['foo()' => 'F']`` requires
  method ``foo()`` to return ``'F'``,
- ``$class`` - name of the class to be examined,
- ``$message`` - optional failure message,

The method

.. code:: php

  function assertNotClassPropertiesIdenticalTo(array $expected, string $class[, string $message = ''])

is the inverse of this.

.. literalinclude:: ../../examples/phpunit-properties/AssertClassPropertiesIdenticalToTest.php
   :linenos:
   :caption: Usage of assertClassPropertiesIdenticalTo()
   :name: phpunit-properties.assertions.assertClassPropertiesIdenticalTo.example

.. literalinclude:: ../../examples/phpunit-properties/AssertClassPropertiesIdenticalToTest.stdout
  :linenos:
  :language: none


.. _phpunit-properties.assertions.assertObjectPropertiesEqualTo:

assertObjectPropertiesEqualTo()
-------------------------------

Synopsis:

.. code:: php

  function assertObjectPropertiesEqualTo(array $expected, object $object[, string $message = ''])

Reports an error identified by ``$message`` if ``$object``'s properties are not
equal to ``$expected`` ones (tested with ``==`` operator).
A property is either an attribute value or a value returned by object's method
that is callable without arguments. The method compares only properties
described in ``$expected``, so ``$expected = []`` accepts any ``$object``.

The arguments are:

- ``$expected`` - an associative array with property names as keys and their
  expected values as values, if a key ends with ``"()"``, then the property is
  assumed to be a method, for example ``$expected = ['foo()' => 'F']`` requires
  method ``foo()`` to return ``'F'``,
- ``$object`` - an object to be examined,
- ``$message`` - optional failure message,

The method

.. code:: php

  function assertNotObjectPropertiesEqualTo(array $expected, object $object[, string $message = ''])

is the inverse of this.

.. literalinclude:: ../../examples/phpunit-properties/AssertObjectPropertiesEqualToTest.php
   :linenos:
   :caption: Usage of assertObjectPropertiesEqualTo()
   :name: phpunit-properties.assertions.assertObjectPropertiesEqualTo.example

.. literalinclude:: ../../examples/phpunit-properties/AssertObjectPropertiesEqualToTest.stdout
  :linenos:
  :language: none

.. _phpunit-properties.assertions.assertObjectPropertiesIdenticalTo:

assertObjectPropertiesIdenticalTo()
-----------------------------------

Synopsis:

.. code:: php

  function assertObjectPropertiesIdenticalTo(array $expected, object $object[, string $message = ''])

Reports an error identified by ``$message`` if ``$object``'s properties are not
identical with ``$expected`` ones (tested with ``===`` operator).
A property is either an attribute value or a value returned by object's method
that is callable without arguments. The method compares only properties
described in ``$expected``, so ``$expected = []`` accepts any ``$object``.

The arguments are:

- ``$expected`` - an associative array with property names as keys and their
  expected values as values, if a key ends with ``"()"``, then the property is
  assumed to be a method, for example ``$expected = ['foo()' => 'F']`` requires
  method ``foo()`` to return ``'F'``,
- ``$object`` - an object to be examined,
- ``$message`` - optional failure message,

The method

.. code:: php

  function assertNotObjectPropertiesIdenticalTo(array $expected, array $matches[, string $message = ''])

is the inverse of this.

.. literalinclude:: ../../examples/phpunit-properties/AssertObjectPropertiesIdenticalToTest.php
   :linenos:
   :caption: Usage of assertObjectPropertiesIdenticalTo()
   :name: phpunit-properties.assertions.assertObjectPropertiesIdenticalTo.example

.. literalinclude:: ../../examples/phpunit-properties/AssertObjectPropertiesIdenticalToTest.stdout
  :linenos:
  :language: none

.. <!--- vim: set syntax=rst spell: -->
