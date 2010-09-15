<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class TestDepositInstitute extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*firefox");
    $this->setBrowserUrl("http://opus4web.zib.de/");
  }

  public function testDepositInstitute()
  {
    $this->open("/opus4-selenium/publish");
    $this->type("documentType", "preprint");
    $this->type("documentId", "");
    $this->type("fulltext", "0");
    $this->click("send");
    $this->type("PersonAuthor1FirstName", "Susanne");
    $this->type("PersonAuthor1LastName", "Gottwald");
    $this->select("Institute1", "label=Zuse Institute Berlin (ZIB)");
    $this->select("Language", "label=English");
    $this->type("TitleMain1", "Entenhausen");
    $this->select("TitleMain1Language", "label=English");
    $this->select("Project1", "label=A12");
    $this->type("SubjectMSC1", "00A09");
    $this->click("send");
    $this->type("SubjectMSC1", "00A0");
    $this->click("send");
  }
}
?>