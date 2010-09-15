<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class InvalidMSCTest extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*firefox");
    $this->setBrowserUrl("http://opus4web.zib.de/");
  }

  public function testInvalidMSCCase()
  {
    $this->open("/opus4-matheon/home");
    $this->click("link=Publish");
    $this->select("documentType", "label=Preprint");
    $this->click("send");
    $this->type("PersonAuthor1FirstName", "Susanne");
    $this->type("PersonAuthor1LastName", "Gottwald");
    $this->select("Institute1", "label=Zuse Institute Berlin (ZIB)");
    $this->select("Language", "label=English");
    $this->type("TitleMain1", "Entenhausen");
    $this->select("TitleMain1Language", "label=English");
    $this->select("Project1", "label=A1");
    $this->type("SubjectMSC1", "00A0");
    $this->click("send");
    try {
        $this->assertTrue($this->isTextPresent("Errors occurred. Please check the error messages beside the form fields."));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    try {
        $this->assertTrue($this->isTextPresent("is not a valid MSC class."));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->type("SubjectMSC1", "00A09");
    $this->click("send");
    try {
        $this->assertTrue($this->isTextPresent("Please check your data."));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->type("SubjectMSC1", "00A0");
    $this->click("send");
    try {
        $this->assertTrue($this->isTextPresent("is not a valid MSC class."));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->type("SubjectMSC1", "00A09");
    $this->click("send");
    try {
        $this->assertTrue($this->isTextPresent("Publishing document successful"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
  }
}
?>