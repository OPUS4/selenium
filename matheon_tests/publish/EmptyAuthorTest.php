<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class EmptyAuthorTest extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*firefox");
    $this->setBrowserUrl("http://opus4web.zib.de/");
  }

  public function testEmptyAuthorsCase()
  {
    $this->open("/opus4-matheon/publish/form/check");
    $this->click("link=Publish");
    $this->waitForPageToLoad("30000");    
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->type("PersonAuthor1FirstName", "Susanne");
    $this->type("PersonAuthor1LastName", "Gottwald");
    $this->click("addMorePersonAuthor");
    $this->select("Institute1", "label=Zuse Institute Berlin (ZIB)");
    $this->select("Language", "label=English");
    $this->type("TitleMain1", "Entenhausen");
    $this->select("TitleMain1Language", "label=English");
    $this->type("SubjectMSC1", "00A09");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    try {
        $this->assertTrue($this->isTextPresent("Value is required and can't be empty"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->click("deleteMorePersonAuthor");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    try {
        $this->assertTrue($this->isTextPresent("Please check your data."));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
  }
}
?>