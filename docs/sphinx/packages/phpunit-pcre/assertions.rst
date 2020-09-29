.. _phpunit-pcre.assertions:

Assertions
==========

This section lists the various assertion methods that are available.


.. _phpunit-pcre.assertions.assertHasPregCaptures:

assertHasPregCaptures()
-----------------------

Synopsis:

.. code:: php

  function assertHasPregCaptures(array $expected, array $matches[, string $message = ''])

Reports an error identified by ``$message`` if PCRE captures found in
``$matches`` (an array supposedly returned from `preg_match()`_) do not agree
with the expectations prescribed in the ``$expected`` array. The method
verifies only groups described in ``$expected``, so ``$expected = []``
accepts any array of ``$matches``. Expectations are formulated as follows:

- ``$expected = ['foo' => true]`` requires ``$matches['foo']`` to be present,
- ``$expected = ['foo' => false]`` requires ``$matches['foo']`` to be absent,
- ``$expected = ['foo' => 'FOO']`` requires that ``$matches['foo'] === 'FOO'``,

A capture group ``foo`` is considered absent if:

- ``$matches['foo']`` is not set, or
- ``$matches['foo'] === null``, or
- ``$matches['foo'] === [null, ...]``.

.. note::

    The presence/absence checks work only with ``$matches`` returned from
    `preg_match()`_ when invoked with the ``PREG_UNMATCHED_AS_NULL`` flag.

The method

.. code:: php

  function assertNotHasPregCaptures(array $expected, array $matches[, string $message = ''])

is the inverse of this.

.. literalinclude:: ../../examples/phpunit-pcre/AssertHasPregCapturesTest.php
   :linenos:
   :caption: Usage of assertHasPregCaptures()
   :name: phpunit-pcre.assertions.assertHasPregCaptures.example

.. literalinclude:: ../../examples/phpunit-pcre/AssertHasPregCapturesTest.stdout
  :linenos:
  :language: none


.. _preg_match(): https://www.php.net/manual/en/function.preg-match.php

.. <!--- vim: set syntax=rst spell: -->
