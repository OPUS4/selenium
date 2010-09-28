<?php

require_once 'TestCase.php';

class Opusvier707Test extends TestCase
{
  
  public function testDeutscheSprachversion()
  {
    $this->open("/opus4-selenium/home/index/language/language/de");
    $this->waitForPageToLoad("30000");
    $this->open("/opus4-selenium/publish");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Veröffentlichen"));
    $this->select("documentType", "label=Ton");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Ton"));
    $this->type("PersonSubmitterFirstName1", "foo");
    $this->type("PersonSubmitterLastName1", "bar");
    $this->type("TitleMain1", "baz");
    $this->select("TitleMainLanguage1", "label=Deutsch");
    $this->type("CompletedDate", "28.09.2010");
    $this->select("Language", "label=Deutsch");
    $this->select("Licence", "label=Creative Commons - Namensnennung");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Fehler: 28.09.2010 scheint kein gültiges Datum zu sein."));
  }

  public function testEnglishLanguageVersion()
  {
    $this->open("/opus4-selenium/home/index/language/language/en");
    $this->waitForPageToLoad("30000");
    $this->open("/opus4-selenium/publish");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Publish"));
    $this->select("documentType", "label=Sound");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Sound"));
    $this->type("PersonSubmitterFirstName1", "foo");
    $this->type("PersonSubmitterLastName1", "bar");
    $this->type("TitleMain1", "baz");
    $this->select("TitleMainLanguage1", "label=German");
    $this->type("CompletedDate", "09/28/2010");
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
