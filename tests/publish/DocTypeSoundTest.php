<?php

require_once 'TestCase.php';

class DocTypeSoundTest extends TestCase
{
  
  public function testDocTypeSound()
  {
    $this->open("/opus4-selenium/publish");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Publish"));
    $this->select("documentType", "label=Sound");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Sound"));
    $this->type("PersonSubmitterFirstName1", "Donald");
    $this->type("PersonSubmitterLastName1", "Trump");
    $this->type("TitleMain1", "Millionär gesucht");
    $this->select("TitleMainLanguage1", "label=German");
    $this->type("PersonAuthorFirstName1", "Donald");
    $this->type("PersonAuthorLastName1", "Trump");
    $this->type("CompletedDate", "2004/03/24");
    $this->select("Language", "label=German");
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
