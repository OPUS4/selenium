<?php

require_once 'TestCase.php';

class PublishAllFieldsTest extends TestCase
{
  public function testMyTestCase()
  {
    $this->open("/opus4-selenium/publish");
    $this->assertTrue($this->isElementPresent("documentType"));
    $this->select("documentType", "label=All fields (testing documenttype)");
    $this->click("rights");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("PersonSubmitterFirstName1"));
    $this->type("PersonAuthorFirstName1", "Steffi");
    $this->assertTrue($this->isElementPresent("PersonAuthorLastName1"));
    $this->type("PersonAuthorLastName1", "Conrad-Rempel");
    $this->assertTrue($this->isElementPresent("PersonAuthorEmail1"));
    $this->type("PersonAuthorEmail1", "conrad-rempel@zib.de");
    $this->assertTrue($this->isElementPresent("PersonAuthorAllowEmailContact1"));
    $this->click("PersonAuthorAllowEmailContact1");
    $this->assertTrue($this->isElementPresent("PersonAuthorDateOfBirth1"));
    $this->type("PersonAuthorDateOfBirth1", "01.01.1965");
    $this->assertTrue($this->isElementPresent("PersonAuthorPlaceOfBirth1"));
    $this->type("PersonAuthorPlaceOfBirth1", "Berlin");
    $this->assertTrue($this->isElementPresent("Language"));
    $this->assertTrue($this->isElementPresent("TitleMain1"));
    $this->type("TitleMain1", "Testdokument mit allen Feldern");
    $this->assertTrue($this->isElementPresent("TitleMainLanguage1"));
    $this->click("addMoreTitleMain");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("TitleMain2"));
    $this->type("TitleMain2", "Document for Testing with all Fields");
    $this->assertTrue($this->isElementPresent("TitleMainLanguage2"));
    $this->select("TitleMainLanguage2", "label=English");
    $this->assertTrue($this->isElementPresent("TitleAbstract1"));
    $this->type("TitleAbstract1", "Ein Testdokument mit allen Feldern.");
    $this->assertTrue($this->isElementPresent("TitleAbstractLanguage1"));
    $this->assertTrue($this->isElementPresent("addMoreTitleAbstract"));
    $this->click("addMoreTitleAbstract");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("TitleAbstract2"));
    $this->type("TitleAbstract2", "A Document with all Fields.");
    $this->assertTrue($this->isElementPresent("TitleAbstractLanguage2"));
    $this->select("TitleAbstractLanguage2", "label=English");
    $this->assertTrue($this->isElementPresent("deleteMoreTitleAbstract"));
    $this->assertTrue($this->isElementPresent("TitleSub1"));
    $this->type("TitleSub1", "Mit Kommentaren");
    $this->assertTrue($this->isElementPresent("TitleSubLanguage1"));
    $this->assertTrue($this->isElementPresent("TitleAdditional1"));
    $this->type("TitleAdditional1", "Document de test avec tous les champs");
    $this->assertTrue($this->isElementPresent("TitleAdditionalLanguage1"));
    $this->assertTrue($this->isElementPresent("TitleParent1"));
    $this->type("TitleParent1", "Lexikon der Tests");
    $this->assertTrue($this->isElementPresent("TitleParentLanguage1"));
    $this->assertTrue($this->isElementPresent("SubjectMSC1"));
    $this->select("SubjectMSC1", "label=00-XX GENERAL");
    $this->click("browseDownSubjectMSC");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("browseUpSubjectMSC"));
    $this->click("browseDownSubjectMSC");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("SubjectDDC1"));
    $this->select("SubjectDDC1", "label=0 Informatik, Informationswissenschaft, allgemeine Werke");
    $this->click("browseDownSubjectDDC");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("browseUpSubjectDDC"));
    $this->click("browseDownSubjectDDC");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("collId3SubjectDDC1"));
    $this->assertTrue($this->isElementPresent("SubjectCCS1"));
    $this->select("SubjectCCS1", "label=A. General Literature");
    $this->click("browseDownSubjectCCS");
    $this->waitForPageToLoad("30000");
    $this->click("browseDownSubjectCCS");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("collId3SubjectCCS1"));
    $this->assertTrue($this->isElementPresent("SubjectPACS1"));
    $this->select("SubjectPACS1", "label=00.00.00 GENERAL");
    $this->click("browseDownSubjectPACS");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("collId2SubjectPACS1"));
    $this->click("browseDownSubjectPACS");
    $this->waitForPageToLoad("30000");
    $this->select("SubjectJEL1", "label=D Microeconomics");
    $this->assertTrue($this->isElementPresent("SubjectJEL1"));
    $this->click("browseDownSubjectJEL");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("collId2SubjectJEL1"));
    $this->click("browseDownSubjectJEL");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("collId3SubjectJEL1"));
    $this->assertTrue($this->isElementPresent("Series1"));
    $this->select("Series1", "label=Jahresbericht des Präsidenten");
    $this->assertTrue($this->isElementPresent("PageNumber"));
    $this->type("PageNumber", "465");
    $this->assertTrue($this->isElementPresent("PageFirst"));
    $this->type("PageFirst", "1");
    $this->assertTrue($this->isElementPresent("PageLast"));
    $this->type("PageLast", "455");
    $this->assertTrue($this->isElementPresent("Volume"));
    $this->type("Volume", "5");
    $this->assertTrue($this->isElementPresent("Issue"));
    $this->type("Issue", "12");
    $this->assertTrue($this->isElementPresent("Edition"));
    $this->type("Edition", "3., erw. Aufl.");
    $this->assertTrue($this->isElementPresent("Institute1"));
    $this->select("Institute1", "label=Technische Universität Hamburg-Harburg");
    $this->click("browseDownInstitute");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("collId2Institute1"));
    $this->click("browseDownInstitute");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("collId3Institute1"));
    $this->assertTrue($this->isElementPresent("PublishedYear"));
    $this->type("PublishedYear", "2010");
    $this->assertTrue($this->isElementPresent("PublishedDate"));
    $this->type("PublishedDate", "15.08.2010");
    $this->assertTrue($this->isElementPresent("PublisherName"));
    $this->type("PublisherName", "Hanser");
    $this->assertTrue($this->isElementPresent("PublisherPlace"));
    $this->type("PublisherPlace", "München");
    $this->assertTrue($this->isElementPresent("CompletedYear"));
    $this->type("CompletedYear", "2009");
    $this->assertTrue($this->isElementPresent("CompletedDate"));
    $this->assertTrue($this->isElementPresent("IdentifierUrn"));
    $this->type("IdentifierUrn", "urn:nbn:de:kobv:test-opus-1296");
    $this->assertTrue($this->isElementPresent("IdentifierIsbn"));
    $this->type("IdentifierIsbn", "978-3-446-42682-5");
    $this->assertTrue($this->isElementPresent("IdentifierIssn"));
    $this->type("IdentifierIssn", "5345-4588");
    $this->assertTrue($this->isElementPresent("ThesisDateAccepted"));
    $this->type("ThesisDateAccepted", "19.03.2008");
    $this->assertTrue($this->isElementPresent("ThesisGrantor1"));
    $this->select("ThesisGrantor1", "label=Foobar Universität");
    $this->assertTrue($this->isElementPresent("ThesisPublisher1"));
    $this->select("ThesisPublisher1", "label=Foobar Universitätsbibliothek");
    $this->assertTrue($this->isElementPresent("PersonRefereeFirstName1"));
    $this->type("PersonRefereeFirstName1", "Gerd");
    $this->assertTrue($this->isElementPresent("PersonRefereeLastName1"));
    $this->type("PersonRefereeLastName1", "Gredo");
    $this->assertTrue($this->isElementPresent("PersonEditorFirstName1"));
    $this->type("PersonEditorFirstName1", "Billy");
    $this->assertTrue($this->isElementPresent("PersonEditorLastName1"));
    $this->type("PersonEditorLastName1", "Idol");
    $this->assertTrue($this->isElementPresent("PersonAdvisorFirstName1"));
    $this->type("PersonAdvisorFirstName1", "Thorsten");
    $this->assertTrue($this->isElementPresent("PersonAdvisorLastName1"));
    $this->type("PersonAdvisorLastName1", "Koch");
    $this->assertTrue($this->isElementPresent("PersonTranslatorFirstName1"));
    $this->type("PersonTranslatorFirstName1", "Beate");
    $this->assertTrue($this->isElementPresent("PersonTranslatorLastName1"));
    $this->type("PersonTranslatorLastName1", "Rusch");
    $this->assertTrue($this->isElementPresent("PersonContributorFirstName1"));
    $this->type("PersonContributorFirstName1", "Anja");
    $this->assertTrue($this->isElementPresent("PersonContributorLastName1"));
    $this->type("PersonContributorLastName1", "Kammel");
    $this->assertTrue($this->isElementPresent("CreatingCorporation"));
    $this->type("CreatingCorporation", "Zuse Institut Berlin");
    $this->assertTrue($this->isElementPresent("ContributingCorporation"));
    $this->type("ContributingCorporation", "Freie Universität Berlin");
    $this->assertTrue($this->isElementPresent("SubjectSwd1"));
    $this->type("SubjectSwd1", "Berlin");
    $this->assertTrue($this->isElementPresent("SubjectUncontrolled1"));
    $this->type("SubjectUncontrolled1", "Testen");
    $this->assertTrue($this->isElementPresent("SubjectUncontrolledLanguage1"));
    $this->assertTrue($this->isElementPresent("Note"));
    $this->type("Note", "Test Test...");
    $this->assertTrue($this->isElementPresent("Licence"));
    $this->select("Licence", "label=Creative Commons - Namensnennung");
    $this->click("EnrichmentLegalNotices");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->type("PersonAuthorDateOfBirth1", "1965/01/01");
    $this->type("ThesisDateAccepted", ".2008/03/19");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->type("PublishedDate", "2010/08/15");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->click("back");
    $this->waitForPageToLoad("30000");
    $this->type("ThesisDateAccepted", "2008/03/19");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("link=Go to publish form"));
  }
}
?>
