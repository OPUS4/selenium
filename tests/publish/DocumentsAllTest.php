<?php

require_once 'TestCase.php';

class DocumentsAllTest extends TestCase
{
  
  public function testMyTestCase()
  {
    $this->open("/opus4-selenium/publish");
    $this->select("documentType", "label=Alle Felder (Testdokumenttyp)");
    $this->click("bibliographie");
    $this->click("rights");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->type("PersonAuthorFirstName1", "Steffi");
    $this->type("PersonAuthorLastName1", "Conrad-Rempel");
    $this->type("PersonAuthorEmail1", "conrad-rempel@zib.de");
    $this->click("PersonAuthorAllowEmailContact1");
    $this->type("PersonAuthorDateOfBirth1", "01.01.1965");
    $this->type("PersonAuthorPlaceOfBirth1", "Berlin");
    $this->type("TitleMain1", "Testdokument mit allen Feldern");
    $this->type("TitleAbstract1", "Ein Testdokument mit allen Feldern, um den Export zu prüfen.");
    $this->click("addMoreTitleMain");
    $this->waitForPageToLoad("30000");
    $this->type("TitleMain2", "Document for Testing with all Fields");
    $this->select("TitleMainLanguage2", "label=Englisch");
    $this->click("addMoreTitleAbstract");
    $this->waitForPageToLoad("30000");
    $this->type("TitleAbstract2", "A Document with all Fields to test the Export.");
    $this->select("TitleAbstractLanguage2", "label=Englisch");
    $this->type("TitleSub1", "Mit Kommentaren");
    $this->type("TitleAdditional1", "Document de test avec tous les champs");
    $this->type("TitleParent1", "Lexikon der Tests");
    $this->select("PublicationState", "label=accepted");
    $this->select("EnrichmentNeuesSelect1", "label=knallo");
    $this->select("SubjectMSC1", "label=00-XX GENERAL");
    $this->click("browseDownSubjectMSC");
    $this->waitForPageToLoad("30000");
    $this->click("browseDownSubjectMSC");
    $this->waitForPageToLoad("30000");
    $this->select("SubjectDDC1", "label=4 Sprache");
    $this->click("browseDownSubjectDDC");
    $this->waitForPageToLoad("30000");
    $this->click("browseDownSubjectDDC");
    $this->waitForPageToLoad("30000");
    $this->select("SubjectCCS1", "label=A. General Literature");
    $this->click("browseDownSubjectCCS");
    $this->waitForPageToLoad("30000");
    $this->click("browseDownSubjectCCS");
    $this->waitForPageToLoad("30000");
    $this->select("collId3SubjectCCS1", "label=General literary works (e.g., fiction, plays)");
    $this->select("SubjectPACS1", "label=20.00.00 NUCLEAR PHYSICS");
    $this->click("browseDownSubjectPACS");
    $this->waitForPageToLoad("30000");
    $this->click("browseDownSubjectPACS");
    $this->waitForPageToLoad("30000");
    $this->click("browseDownSubjectPACS");
    $this->waitForPageToLoad("30000");
    $this->select("collId4SubjectPACS1", "label=21.10.Ma Level density");
    $this->select("SubjectJEL1", "label=J Labor and Demographic Economics");
    $this->click("browseDownSubjectJEL");
    $this->waitForPageToLoad("30000");
    $this->select("collId2SubjectJEL1", "label=J3 Wages, Compensation, and Labor Costs");
    $this->click("browseDownSubjectJEL");
    $this->waitForPageToLoad("30000");
    $this->select("collId3SubjectJEL1", "label=J32 Nonwage Labor Costs and Benefits; Private Pensions");
    $this->type("SeriesNumber1", "15");
    $this->select("Series1", "label=Jahresbericht des Präsidenten");
    $this->type("EnrichmentNeuesFeld1", "Testenrichmentfeld");
    $this->type("PageNumber", "465");
    $this->type("PageFirst", "1");
    $this->type("PageLast", "455");
    $this->type("Volume", "5");
    $this->type("Issue", "12");
    $this->type("Edition", "3., erw. Aufl.");
    $this->select("Institute1", "label=Technische Universität Hamburg-Harburg");
    $this->click("browseDownInstitute");
    $this->waitForPageToLoad("30000");
    $this->select("collId2Institute1", "label=Gewerblich-Technische Wissenschaften");
    $this->click("browseDownInstitute");
    $this->waitForPageToLoad("30000");
    $this->type("PublishedYear", "2010");
    $this->type("PublishedDate", "15.08.2010");
    $this->type("PublisherName", "Hanser");
    $this->type("PublisherPlace", "München");
    $this->type("CompletedYear", "2009");
    $this->type("IdentifierOpus3", "3485");
    $this->type("IdentifierUrn", "urn:nbn:de:kobv:test-opus-1296");
    $this->type("IdentifierIsbn", "978-3-446-42682-5");
    $this->type("IdentifierIssn", "5345-4588");
    $this->type("IdentifierOpac", "434f");
    $this->type("ThesisDateAccepted", "19.03.2008");
    $this->select("ThesisGrantor1", "label=Foobar Universität");
    $this->select("ThesisPublisher1", "label=Foobar Universitätsbibliothek");
    $this->type("PersonRefereeFirstName1", "Gerd");
    $this->type("PersonRefereeLastName1", "Gredo");
    $this->type("PersonEditorFirstName1", "Billy");
    $this->type("PersonEditorLastName1", "Idol");
    $this->type("PersonAdvisorFirstName1", "Thorsten");
    $this->type("PersonAdvisorLastName1", "Koch");
    $this->type("PersonTranslatorFirstName1", "Beate");
    $this->type("PersonTranslatorLastName1", "Rusch");
    $this->type("PersonContributorFirstName1", "Anja");
    $this->type("PersonContributorLastName1", "Kammel");
    $this->type("CreatingCorporation", "Zuse Institut Berlin");
    $this->type("ContributingCorporation", "Freie Universität Berlin");
    $this->type("SubjectSwd1", "Berlin");
    $this->type("SubjectUncontrolled1", "Testen");
    $this->type("Note", "Eine Notiz.");
    $this->select("Licence", "label=Creative Commons - Namensnennung");
    $this->click("EnrichmentLegalNotices");
    $this->click("send");
    $this->waitForPageToLoad("30000");
    $this->click("send");
    $this->waitForPageToLoad("30000");
  }
}
?>