Feature: Examples
  @phpunit-inheritance
  Scenario Outline: Examples for php-fox/phpunit-inheritance
    Given I tested <example_file> with PHPUnit
    Then I should see PHPUnit stdout from <stdout_file>
    And I should see stderr from <stderr_file>
    And I should see exit code <exit_code>

    Examples:
      | example_file                                            | stdout_file                                                | stderr_file                                                | exit_code |
      | "phpunit-inheritance/AssertExtendsClassTest.php"        | "phpunit-inheritance/AssertExtendsClassTest.stdout"        | "phpunit-inheritance/AssertExtendsClassTest.stderr"        | 1         |
      | "phpunit-inheritance/AssertImplementsInterfaceTest.php" | "phpunit-inheritance/AssertImplementsInterfaceTest.stdout" | "phpunit-inheritance/AssertImplementsInterfaceTest.stderr" | 1         |
      | "phpunit-inheritance/AssertUsesTraitTest.php"           | "phpunit-inheritance/AssertUsesTraitTest.stdout"           | "phpunit-inheritance/AssertUsesTraitTest.stderr"           | 1         |
      | "phpunit-inheritance/extendsClassTest.php"              | "phpunit-inheritance/extendsClassTest.stdout"              | "phpunit-inheritance/extendsClassTest.stderr"              | 1         |
      | "phpunit-inheritance/implementsInterfaceTest.php"       | "phpunit-inheritance/implementsInterfaceTest.stdout"       | "phpunit-inheritance/implementsInterfaceTest.stderr"       | 1         |
      | "phpunit-inheritance/usesTraitTest.php"                 | "phpunit-inheritance/usesTraitTest.stdout"                 | "phpunit-inheritance/usesTraitTest.stderr"                 | 1         |

  @phpunit-pcre
  Scenario Outline: Examples for php-fox/phpunit-pcre
    Given I tested <example_file> with PHPUnit
    Then I should see PHPUnit stdout from <stdout_file>
    And I should see stderr from <stderr_file>
    And I should see exit code <exit_code>

    Examples:
      | example_file                                  | stdout_file                                     | stderr_file                                     | exit_code |
      | "phpunit-pcre/AssertHasPregCapturesTest.php"  | "phpunit-pcre/AssertHasPregCapturesTest.stdout" | "phpunit-pcre/AssertHasPregCapturesTest.stderr" | 1         |
      | "phpunit-pcre/hasPregCapturesTest.php"        | "phpunit-pcre/hasPregCapturesTest.stdout"       | "phpunit-pcre/hasPregCapturesTest.stderr"       | 1         |

  @phpunit-properties
  Scenario Outline: Examples for php-fox/phpunit-properties
    Given I tested <example_file> with PHPUnit
    Then I should see PHPUnit stdout from <stdout_file>
    And I should see stderr from <stderr_file>
    And I should see exit code <exit_code>

    Examples:
      | example_file                                                   | stdout_file                                                       | stderr_file                                                       | exit_code |
      | "phpunit-properties/AssertClassPropertiesEqualToTest.php"      | "phpunit-properties/AssertClassPropertiesEqualToTest.stdout"      | "phpunit-properties/AssertClassPropertiesEqualToTest.stderr"      | 1         |
      | "phpunit-properties/AssertClassPropertiesIdenticalToTest.php"  | "phpunit-properties/AssertClassPropertiesIdenticalToTest.stdout"  | "phpunit-properties/AssertClassPropertiesIdenticalToTest.stderr"  | 1         |
      | "phpunit-properties/AssertObjectPropertiesEqualToTest.php"     | "phpunit-properties/AssertObjectPropertiesEqualToTest.stdout"     | "phpunit-properties/AssertObjectPropertiesEqualToTest.stderr"     | 1         |
      | "phpunit-properties/AssertObjectPropertiesIdenticalToTest.php" | "phpunit-properties/AssertObjectPropertiesIdenticalToTest.stdout" | "phpunit-properties/AssertObjectPropertiesIdenticalToTest.stderr" | 1         |
      | "phpunit-properties/classPropertiesEqualToTest.php"            | "phpunit-properties/classPropertiesEqualToTest.stdout"            | "phpunit-properties/classPropertiesEqualToTest.stderr"            | 1         |
      | "phpunit-properties/classPropertiesIdenticalToTest.php"        | "phpunit-properties/classPropertiesIdenticalToTest.stdout"        | "phpunit-properties/classPropertiesIdenticalToTest.stderr"        | 1         |
      | "phpunit-properties/objectPropertiesEqualToTest.php"           | "phpunit-properties/objectPropertiesEqualToTest.stdout"           | "phpunit-properties/objectPropertiesEqualToTest.stderr"           | 1         |
      | "phpunit-properties/objectPropertiesIdenticalToTest.php"       | "phpunit-properties/objectPropertiesIdenticalToTest.stdout"       | "phpunit-properties/objectPropertiesIdenticalToTest.stderr"       | 1         |
