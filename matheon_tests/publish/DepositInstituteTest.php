<?php

require_once 'TestCase.php';

class DepositInstituteTest extends TestCase
{

  public function testdepositInstitute()
  {
    $this->open("/opus4-matheon/home");
    $this->click("link=Publish");
    $this->waitForPageToLoad("30000");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->type("PersonAuthor1FirstName", "Susanne");
    $this->type("PersonAuthor1LastName", "Gottwald");
    $this->select("Institute1", "label=Zuse Institute Berlin (ZIB)");
    $this->select("Language", "label=English");
    $this->type("TitleMain1", "Entenhausen");
    $this->select("TitleMain1Language", "label=English");
    $this->select("TitleAbstract1Language", "label=English");
    $this->select("Project1", "label=A10");
    $this->type("SubjectMSC1", "00A09");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->type("SubjectMSC1", "00A0");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    try {
        $this->assertFalse($this->isTextPresent("( ! ) Notice: Undefined offset: 0 "));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
  }
}
?>
