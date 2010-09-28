<?php

require_once 'TestCase.php';

class TonTest extends TestCase
{
  
  public function testDocTypeTon()
  {
    $this->open("/opus4-selenium/home");
    $this->waitForPageToLoad("30000");
	$this->click("//li[@id='primary-nav-publish']/a/span");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Veröffentlichen"));
    $this->select("documentType", "label=Ton");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Ton"));
    $this->type("PersonSubmitterFirstName1", "Donald");
    $this->type("PersonSubmitterLastName1", "Trump");
    $this->type("TitleMain1", "Millionär gesucht");
    $this->select("TitleMainLanguage1", "label=Deutsch");
    $this->type("PersonAuthorFirstName1", "Donald");
    $this->type("PersonAuthorLastName1", "Trump");
    $this->type("CompletedDate", "28.09.2010");
    $this->select("Language", "label=Deutsch");
    $this->select("Licence", "label=Creative Commons - Namensnennung");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Bitte überprüfen Sie Ihre Eingaben."));
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Das Dokument wurde erfolgreich gespeichert."));
  }
}
?>