<?php

require_once 'TestCase.php';

class DoeSearchTest extends TestCase
{

  public function testDoeSearch()
  {
    $this->open("/opus4-selenium/solrsearch");
    $this->type("query", "doe");
    $this->click("//input[@value='Search']");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("5 search hits"));
    $this->assertTrue($this->isTextPresent("1 to 5"));
  }
}
?>
