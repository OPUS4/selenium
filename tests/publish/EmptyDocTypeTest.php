<?php

require_once 'TestCase.php';

class EmptyDocTypeTest extends TestCase
{

  public function testDepositInstitute()
  {
    $this->open("/opus4-selenium/home");
    $this->click("link=Publish");
    $this->waitForPageToLoad("30000");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    try {
        $this->assertTrue($this->isTextPresent("Value is required and can't be empty"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
  }
}
?>
