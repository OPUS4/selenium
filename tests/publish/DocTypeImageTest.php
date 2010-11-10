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
    $this->type("PersonSubmitterEmail1", "test@mail.com");
    $this->type("TitleMain1", "The Tales of Entenhausen");
    $this->select("TitleMainLanguage1", "label=English");
    $this->type("CompletedDate", "2004/03/12");
    $this->select("Language", "label=English");
    $this->select("Licence", "label=Creative Commons - Namensnennung");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Please check your data."));
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Your document was successfully stored."));
  }
}
?>
