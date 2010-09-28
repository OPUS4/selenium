<?php

require_once 'TestCase.php';

class ImageTest extends TestCase
{
  
  public function testDocTypImage()
  {
    $this->open("/opus4-selenium/publish");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Publish"));
    $this->assertTrue($this->isTextPresent("Choose document type and file"));
    $this->select("documentType", "label=Image");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Publish"));
    $this->assertTrue($this->isTextPresent("Image"));
    $this->type("PersonSubmitterFirstName1", "Donald");
    $this->type("PersonSubmitterLastName1", "Duck");
    $this->type("TitleMain1", "The Tales of Entenhausen");
    $this->select("TitleMainLanguage1", "label=English");
    $this->type("CompletedDate", "12.03.2004");
    $this->select("Language", "label=English");
    $this->select("Licence", "label=Creative Commons - Namensnennung");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Please check your data."));
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Publishing document successful"));
  }
}
?>