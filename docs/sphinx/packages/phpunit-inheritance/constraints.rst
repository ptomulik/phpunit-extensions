.. _phpunit-inheritance.constraints:

Constraints
===========
This section lists the various constraint methods that are available.


.. _phpunit-inheritance.constraints.extendsClass:

extendsClass
------------

Synopsis:

.. code:: php

  function extendsClass(string $parent)

Creates :class:`PHPFox\\PHPUnit\\Constraint\\ExtendsClass` constraint.

The constraint accepts objects (and classes) that extend ``$parent`` class. The
examined ``$subject`` may be an ``object`` or a class name as ``string``:

- if the ``$subject`` is an ``object``, then this object's class, as returned
  by ``get_class($subject)``, is examined against ``$parent``, the constraint
  returns ``true`` only if the class extends the ``$parent`` class,
- otherwise, the necessary conditions for the constraint to be satisfied are
  that

  - ``$subject`` is a string,
  - ``class_exists($subject)`` is ``true``, and
  - the ``$subject`` class extends the ``$parent`` class.

.. literalinclude:: ../../examples/phpunit-inheritance/extendsClassTest.php
   :linenos:
   :caption: Usage of extendsClass()
   :name: phpunit-inheritance.assertions.extendsClass.example

.. literalinclude:: ../../examples/phpunit-inheritance/extendsClassTest.stdout
  :linenos:
  :language: none


.. _phpunit-inheritance.constraints.implementsInterface:

implementsInterface
-------------------

Synopsis:

.. code:: php

  function implementsInterface(array $interface)

Creates :class:`PHPFox\\PHPUnit\\Constraint\\ImplementsInterface` constraint.

The constraint accepts objects (and classes/interfaces) that implement given
``$interface``.

.. literalinclude:: ../../examples/phpunit-inheritance/implementsInterfaceTest.php
   :linenos:
   :caption: Usage of implementsInterface()
   :name: phpunit-inheritance.assertions.implementsInterface.example

.. literalinclude:: ../../examples/phpunit-inheritance/implementsInterfaceTest.stdout
  :linenos:
  :language: none


.. _phpunit-inheritance.constraints.usesTrait:

usesTrait
---------

Synopsis:

.. code:: php

  function usesTrait(array $trait)

Creates :class:`PHPFox\\PHPUnit\\Constraint\\UsesTrait` constraint.

The constraint accepts objects (and classes) that use given ``$trait``.

.. literalinclude:: ../../examples/phpunit-inheritance/usesTraitTest.php
   :linenos:
   :caption: Usage of usesTrait()
   :name: phpunit-inheritance.assertions.usesTrait.example

.. literalinclude:: ../../examples/phpunit-inheritance/usesTraitTest.stdout
  :linenos:
  :language: none


.. <!--- vim: set syntax=rst spell: -->
