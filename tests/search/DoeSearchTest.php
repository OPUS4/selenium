<?php

require_once 'TestCase.php';

class DoeSearchTest extends TestCase
{

  public function testDoeSearch()
  {
    $this->open("/opus4-selenium/home");
    try {
        $this->assertTrue($this->isTextPresent("Opus 4"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->type("query", "doe");
    $this->click("//input[@value='Search']");
    $this->waitForPageToLoad("30000");
    try {
        $this->assertTrue($this->isTextPresent("5 Search Results"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->isTextPresent("Display of results 1 to 5"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
  }
}
?>
