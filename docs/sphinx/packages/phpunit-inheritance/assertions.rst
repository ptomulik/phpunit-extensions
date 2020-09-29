.. _phpunit-inheritance.assertions:

Assertions
==========

This section lists the various assertion methods that are available.

.. _phpunit-inheritance.assertions.assertExtendsClass:

assertExtendsClass()
--------------------

Synopsis:

.. code:: php

  function assertExtendsClass(string $parent, mixed $subject[, string $message = ''])

Reports an error identified by ``$message`` if ``$subject`` does not extend the
``$parent`` class. The ``$subject`` may be an ``object`` or a class name as
``string``:

- if ``$subject`` is an ``object``, then its class, as returned by
  ``get_class($subject)``, is examined against ``$parent``, the assertion
  succeeds only if the class extends the ``$parent`` class,
- otherwise, the necessary conditions for the assertion to succeed are that

  - ``$subject`` is a string,
  - ``class_exists($subject)`` is ``true``, and
  - the ``$subject`` class extends the ``$parent`` class.

The method

.. code:: php

  function assertNotExtendsClass(string $parent, mixed $subject[, string $message = ''])

is the inverse of this.

.. literalinclude:: ../../examples/phpunit-inheritance/AssertExtendsClassTest.php
   :linenos:
   :caption: Usage of assertExtendsClass()
   :name: phpunit-inheritance.assertions.assertExtendsClass.example

.. literalinclude:: ../../examples/phpunit-inheritance/AssertExtendsClassTest.stdout
  :linenos:
  :language: none


.. _phpunit-inheritance.assertions.assertImplementsInterface:

assertImplementsInterface()
---------------------------

Synopsis:

.. code:: php

  function assertImplementsInterface(string $interface, mixed $subject[, string $message = ''])

Reports an error identified by ``$message`` if ``$subject`` does not implement
the ``$interface``. The ``$subject`` may be an ``object`` or a class/interface
name as ``string``:

- if ``$subject`` is an ``object``, then its class, as returned by
  ``get_class($subject)``, is examined against ``$interface``, the assertion
  succeeds only if the class implements the ``$interface``,
- otherwise, the necessary conditions for the assertion to succeed are that

  - ``$subject`` is a string,
  - ``class_exists($subject)`` is ``true`` or ``interface_exists($subject)`` is
    ``true``, and
  - the ``$subject`` implements the ``$interface``.

The method

.. code:: php

  function assertNotImplementsInterface(string $interface, mixed $subject[, string $message = ''])

is the inverse of this.

.. literalinclude:: ../../examples/phpunit-inheritance/AssertImplementsInterfaceTest.php
   :linenos:
   :caption: Usage of assertImplementsInterface()
   :name: phpunit-inheritance.assertions.assertImplementsInterface.example

.. literalinclude:: ../../examples/phpunit-inheritance/AssertImplementsInterfaceTest.stdout
  :linenos:
  :language: none

.. _phpunit-inheritance.assertions.assertUsesTrait:

assertUsesTrait()
-----------------

Synopsis:

.. code:: php

  function assertUsesTrait(string $trait, mixed $subject[, string $message = ''])

Reports an error identified by ``$message`` if ``$subject`` does not use the
``$trait``. The ``$subject`` may be an ``object`` or a class name as ``string``:

- if ``$subject`` is an ``object``, then its class, as returned by
  ``get_class($subject)``, is examined against ``$trait``, the assertion
  succeeds only if the class uses the ``$trait``,
- otherwise, the necessary conditions for the assertion to succeed are that

  - ``$subject`` is a string,
  - ``class_exists($subject)`` is ``true``, and
  - the ``$subject`` implements the ``$trait``.

The method

.. code:: php

  function assertNotUsesTrait(string $trait, mixed $subject[, string $message = ''])

is the inverse of this.

.. literalinclude:: ../../examples/phpunit-inheritance/AssertUsesTraitTest.php
   :linenos:
   :caption: Usage of assertUsesTrait()
   :name: phpunit-inheritance.assertions.assertUsesTrait.example

.. literalinclude:: ../../examples/phpunit-inheritance/AssertUsesTraitTest.stdout
  :linenos:
  :language: none

.. <!--- vim: set syntax=rst spell: -->
