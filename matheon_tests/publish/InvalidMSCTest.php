<?php

require_once 'TestCase.php';

class InvalidMscTest extends TestCase
{
  public function testInvalidMscCase()
  {
    $this->open("/opus4-matheon/home");
    $this->click("link=Publish");
    $this->waitForPageToLoad("30000");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->type("PersonAuthorFirstName1", "Susanne");
    $this->type("PersonAuthorLastName1", "Gottwald");
    $this->select("Institute1", "label=Zuse Institute Berlin (ZIB)");
    $this->select("Language", "label=English");
    $this->type("TitleMain1", "Entenhausen");
    $this->select("TitleMainLanguage1", "label=English");
    $this->select("Project1", "label=A1");
    $this->type("SubjectMSC1", "00A0");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Errors occurred. Please check the error messages beside the form fields."));
    $this->assertTrue($this->isTextPresent("The value 00A0 is not a valid MSC class."));
    $this->type("SubjectMSC1", "00A09");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Please check your data."));
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Publishing document successful"));
  }
}
?>
