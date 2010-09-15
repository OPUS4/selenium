<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class InvalidMSCTest extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://opus4web.zib.de");
  }

  public function testInvalidMSC()
  {
    $this->open("/opus4-selenium/publish");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->type("PersonAuthor1FirstName", "Susanne");
    $this->type("PersonAuthor1LastName", "Gottwald");
    $this->select("Institute1", "label=Zuse Institute Berlin (ZIB)");
    $this->select("Language", "label=English");
    $this->type("TitleMain1", "Entenhausen");
    $this->select("TitleMain1Language", "label=English");
    $this->select("Project1", "label=A1");
    $this->type("SubjectMSC1", "00A09");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->type("SubjectMSC1", "00A0");
    $this->click("send");
    $this->waitForPageToLoad("30000");

    try {
        $this->assertTrue($this->isTextPresent("is not a valid MSC class."));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
  }
}
?>