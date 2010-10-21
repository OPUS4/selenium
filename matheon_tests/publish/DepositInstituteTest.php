<?php

require_once 'TestCase.php';

class DepositInstituteTest extends TestCase
{

  public function testdepositInstitute()
  {
    $this->markTestSkipped('how to managed file upload?');
    $this->open("/opus4-matheon/home");
    $this->click("link=Publish");
    $this->waitForPageToLoad("30000");
    $this->click("send");
    $this->waitForPageToLoad("30000");    
    $this->assertTrue($this->isTextPresent("Please upload at least one file."));
    $this->select("documentType", "label=preprintmatheon");
    $this->type("fileupload-0", "Info Vermoegen.pdf");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("Fields that are marked with * have to be filled."));

    $this->type("PersonAuthorFirstName1", "Susanne");
    $this->type("PersonAuthorLastName1", "Gottwald");
    $this->select("Institute1", "label=Zuse Institute Berlin (ZIB)");
    $this->select("Language", "label=English");
    $this->type("TitleMain1", "Entenhausen");
    $this->select("TitleMainLanguage1", "label=English");
    $this->select("Project1", "label=A10");
    $this->type("SubjectMSC1", "00A09");
    $this->type("CompletedDate", "");
    $this->click("send");
    $this->waitForPageToLoad("30000");   
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertFalse($this->isTextPresent("( ! ) Notice: Undefined offset: 0 "));
    $this->assertTrue($this->isTextPresent("Your document was successfully stored."));
  }
}
?>
