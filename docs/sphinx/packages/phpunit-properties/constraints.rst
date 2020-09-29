.. _phpunit-properties.constraints:

Constraints
===========

This section lists the various constraint methods that are available.

.. _phpunit-properties.constraints.classPropertiesEqualTo:

classPropertiesEqualTo
-----------------------

Synopsis:

.. code:: php

  function classPropertiesEqualTo(array $expected)

Creates :class:`PHPFox\\PHPUnit\\Constraint\\ClassPropertiesEqualTo` constraint.

The constraint accepts classes having selected properties equal to
``$expected``.

.. literalinclude:: ../../examples/phpunit-properties/classPropertiesEqualToTest.php
   :linenos:
   :caption: Usage of classPropertiesEqualTo()
   :name: phpunit-properties.assertions.classPropertiesEqualTo.example

.. literalinclude:: ../../examples/phpunit-properties/classPropertiesEqualToTest.stdout
  :linenos:
  :language: none

The constraint may be used recursively, i.e. it may be used to require given
property to be an class with prescribed properties.


.. _phpunit-properties.constraints.classPropertiesIdenticalTo:

classPropertiesIdenticalTo
---------------------------

Synopsis:

.. code:: php

  function classPropertiesIdenticalTo(array $expected)

Creates :class:`PHPFox\\PHPUnit\\Constraint\\ClassPropertiesIdenticalTo` constraint.

The constraint accepts classes having selected properties identical to
``$expected``.

.. literalinclude:: ../../examples/phpunit-properties/classPropertiesIdenticalToTest.php
   :linenos:
   :caption: Usage of classPropertiesIdenticalTo()
   :name: phpunit-properties.assertions.classPropertiesIdenticalTo.example

.. literalinclude:: ../../examples/phpunit-properties/classPropertiesIdenticalToTest.stdout
  :linenos:
  :language: none

The constraint may be used recursively, i.e. it may be used to require given
property to be an class with prescribed properties.


.. _phpunit-properties.constraints.objectPropertiesEqualTo:

objectPropertiesEqualTo
-----------------------

Synopsis:

.. code:: php

  function objectPropertiesEqualTo(array $expected)

Creates :class:`PHPFox\\PHPUnit\\Constraint\\ObjectPropertiesEqualTo` constraint.

The constraint accepts objects having selected properties equal to
``$expected``.

.. literalinclude:: ../../examples/phpunit-properties/objectPropertiesEqualToTest.php
   :linenos:
   :caption: Usage of objectPropertiesEqualTo()
   :name: phpunit-properties.assertions.objectPropertiesEqualTo.example

.. literalinclude:: ../../examples/phpunit-properties/objectPropertiesEqualToTest.stdout
  :linenos:
  :language: none

The constraint may be used recursively, i.e. it may be used to require given
property to be an object with prescribed properties.


.. _phpunit-properties.constraints.objectPropertiesIdenticalTo:

objectPropertiesIdenticalTo
---------------------------

Synopsis:

.. code:: php

  function objectPropertiesIdenticalTo(array $expected)

Creates :class:`PHPFox\\PHPUnit\\Constraint\\ObjectPropertiesIdenticalTo` constraint.

The constraint accepts objects having selected properties identical to
``$expected``.

.. literalinclude:: ../../examples/phpunit-properties/objectPropertiesIdenticalToTest.php
   :linenos:
   :caption: Usage of objectPropertiesIdenticalTo()
   :name: phpunit-properties.assertions.objectPropertiesIdenticalTo.example

.. literalinclude:: ../../examples/phpunit-properties/objectPropertiesIdenticalToTest.stdout
  :linenos:
  :language: none

The constraint may be used recursively, i.e. it may be used to require given
property to be an object with prescribed properties.


.. <!--- vim: set syntax=rst spell: -->
