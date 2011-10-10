<?php

require_once 'TestCase.php';

class CheckedBibliographieFieldTest extends TestCase {

    public function testCheckedBibliographieField() {
        $this->open("/opus4-selenium");
        $this->waitForPageToLoad("30000");
        $this->open("/opus4-selenium/home/index/language/language/de");
        $this->waitForPageToLoad("30000");
        $this->open("/opus4-selenium/publish");
        $this->click("//li[@id='primary-nav-publish']/a/em/span");
        $this->waitForPageToLoad("30000");
        $this->assertTrue($this->isElementPresent("link=English"));

        $this->select("id=documentType", "label=Alle Felder (Testdokumenttyp)");
        $this->click("id=bibliographie");
        $this->click("id=rights");
        $this->click("id=send");
        $this->waitForPageToLoad("30000");
        $this->click("id=EnrichmentLegalNotices");
        $this->click("id=send");
        $this->waitForPageToLoad("30000");
        $this->assertTrue($this->isTextPresent("Bibliographie Dokument wird zur Bibliographie hinzugefügt."));
    }

}

?>
