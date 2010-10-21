<?php

require_once 'TestCase.php';

class EmptyAuthorTest extends TestCase
{

  public function testEmptyAuthorsCase()
  {
    $this->markTestSkipped('how to managed file upload?');
    $this->open("/opus4-matheon/publish");
    $this->click("link=Publish");
    $this->waitForPageToLoad("30000");    
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->type("PersonAuthorFirstName1", "Susanne");
    $this->type("PersonAuthorLastName1", "Gottwald");
    $this->click("addMorePersonAuthor");
    $this->waitForPageToLoad("30000");
    $this->select("Institute1", "label=Zuse Institute Berlin (ZIB)");
    $this->select("Language", "label=English");
    $this->type("TitleMain1", "Entenhausen");
    $this->select("TitleMainLanguage1", "label=English");
    $this->type("SubjectMSC1", "00A09");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Value is required and can't be empty"));
    $this->click("deleteMorePersonAuthor");
    $this->waitForPageToLoad("30000");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Please check your data."));
  }
}
?>
