.. _phpunit-pcre.constraints:

Constraints
===========

This section lists the various constraint methods that are available.


.. _phpunit-pcre.constraints.hasPregCaptures:

hasPregCaptures
---------------

Synopsis:

.. code:: php

  function hasPregCaptures(array $expected)

Creates :class:`PHPFox\\PHPUnit\\Constraint\\HasPregCaptures` constraint.

The constraint accepts arrays of matches returned from ``preg_match()`` having
capture groups as specified in ``$expected``. Only entries present in
``$expected`` are checked, so ``$expected = []`` accepts any array. Special
values may be used in the expectations:

- ``['foo' => false]`` asserts that group ``'foo'`` was not captured,
- ``['foo' => true]`` asserts that group ``'foo'`` was captured,
- ``['foo' => 'FOO']`` asserts that group ``'foo'`` was captured and its value equals ``'FOO'``.

Boolean expectations (``['foo' => true]`` or ``['foo' => false]`` work properly
only with arrays obtained from ``preg_match()`` invoked with
``PREG_UNMATCHED_AS_NULL`` flag.

.. literalinclude:: ../../examples/phpunit-pcre/hasPregCapturesTest.php
   :linenos:
   :caption: Usage of hasPregCaptures()
   :name: phpunit-pcre.assertions.hasPregCaptures.example

.. literalinclude:: ../../examples/phpunit-pcre/hasPregCapturesTest.stdout
  :linenos:
  :language: none


.. <!--- vim: set syntax=rst spell: -->
