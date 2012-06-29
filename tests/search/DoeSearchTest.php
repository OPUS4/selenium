<?php

require_once 'TestCase.php';

class DoeSearchTest extends TestCase
{

  public function testDoeSearch()
  {
    $this->open("/opus4-selenium/solrsearch");
    $this->type("query", "doe");
    $this->click("//input[@value='Search']");
    $this->waitForPageToLoad();
    $this->assertTrue($this->isTextPresent("8 search hits"));
    $this->assertTrue($this->isTextPresent("1 to 8"));
  }
}
?>
