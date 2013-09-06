<?php
/**
 * This file is part of OPUS. The software OPUS has been originally developed
 * at the University of Stuttgart with funding from the German Research Net,
 * the Federal Department of Higher Education and Research and the Ministry
 * of Science, Research and the Arts of the State of Baden-Wuerttemberg.
 *
 * OPUS 4 is a complete rewrite of the original OPUS software and was developed
 * by the Stuttgart University Library, the Library Service Center
 * Baden-Wuerttemberg, the Cooperative Library Network Berlin-Brandenburg,
 * the Saarland University and State Library, the Saxon State Library -
 * Dresden State and University Library, the Bielefeld University Library and
 * the University Library of Hamburg University of Technology with funding from
 * the German Research Foundation and the European Regional Development Fund.
 *
 * LICENCE
 * OPUS is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the Licence, or any later version.
 * OPUS is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details. You should have received a copy of the GNU General Public License
 * along with OPUS; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 *
 * @category    TODO
 * @package     TODO
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2011, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class PublishAllFieldsTest extends TestCase {

    public function testMyTestCase() {
        $this->switchToEnglish();
        $this->open("/publish");
        $this->assertTrue($this->isElementPresent("documentType"));
        $this->select("documentType", "label=All fields (testing documenttype)");
        $this->click("rights");
        $this->click("send");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("PersonSubmitterFirstName_1"));
        $this->type("PersonAuthorFirstName_1", "Steffi");
        $this->assertTrue($this->isElementPresent("PersonAuthorLastName_1"));
        $this->type("PersonAuthorLastName_1", "Conrad-Rempel");
        $this->assertTrue($this->isElementPresent("PersonAuthorEmail_1"));
        $this->type("PersonAuthorEmail_1", "conrad-rempel@zib.de");
        $this->assertTrue($this->isElementPresent("PersonAuthorAllowEmailContact_1"));
        $this->click("PersonAuthorAllowEmailContact_1");
        $this->assertTrue($this->isElementPresent("PersonAuthorDateOfBirth_1"));
        $this->type("PersonAuthorDateOfBirth_1", "01.01.1965");
        $this->assertTrue($this->isElementPresent("PersonAuthorPlaceOfBirth_1"));
        $this->type("PersonAuthorPlaceOfBirth_1", "Berlin");
        $this->assertTrue($this->isElementPresent("Language"));
        $this->assertTrue($this->isElementPresent("TitleMain_1"));
        $this->type("TitleMain_1", "Testdokument mit allen Feldern");
        $this->assertTrue($this->isElementPresent("TitleMainLanguage_1"));
        $this->click("addMoreTitleMain");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("TitleMain_2"));
        $this->type("TitleMain_2", "Document for Testing with all Fields");
        $this->assertTrue($this->isElementPresent("TitleMainLanguage_2"));
        $this->select("TitleMainLanguage_2", "label=English");
        $this->assertTrue($this->isElementPresent("TitleAbstract_1"));
        $this->type("TitleAbstract_1", "Ein Testdokument mit allen Feldern.");
        $this->assertTrue($this->isElementPresent("TitleAbstractLanguage_1"));
        $this->assertTrue($this->isElementPresent("addMoreTitleAbstract"));
        $this->click("addMoreTitleAbstract");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("TitleAbstract_2"));
        $this->type("TitleAbstract_2", "A Document with all Fields.");
        $this->assertTrue($this->isElementPresent("TitleAbstractLanguage_2"));
        $this->select("TitleAbstractLanguage_2", "label=English");
        $this->assertTrue($this->isElementPresent("deleteMoreTitleAbstract"));
        $this->assertTrue($this->isElementPresent("TitleSub_1"));
        $this->type("TitleSub_1", "Mit Kommentaren");
        $this->assertTrue($this->isElementPresent("TitleSubLanguage_1"));
        $this->assertTrue($this->isElementPresent("TitleAdditional_1"));
        $this->type("TitleAdditional_1", "Document de test avec tous les champs");
        $this->assertTrue($this->isElementPresent("TitleAdditionalLanguage_1"));
        $this->assertTrue($this->isElementPresent("TitleParent_1"));
        $this->type("TitleParent_1", "Lexikon der Tests");
        $this->assertTrue($this->isElementPresent("TitleParentLanguage_1"));
        $this->assertTrue($this->isElementPresent("SubjectMSC_1"));
        $this->select("SubjectMSC_1", "label=00-XX GENERAL");
        $this->click("browseDownSubjectMSC");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("browseUpSubjectMSC"));
        $this->click("browseDownSubjectMSC");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("SubjectDDC_1"));
        $this->select("SubjectDDC_1", "label=0 Informatik, Informationswissenschaft, allgemeine Werke");
        $this->click("browseDownSubjectDDC");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("browseUpSubjectDDC"));
        $this->click("browseDownSubjectDDC");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("collId3SubjectDDC_1"));
        $this->assertTrue($this->isElementPresent("SubjectCCS_1"));
        $this->select("SubjectCCS_1", "label=A. General Literature");
        $this->click("browseDownSubjectCCS");
        $this->waitForPageToLoad();
        $this->click("browseDownSubjectCCS");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("collId3SubjectCCS_1"));
        $this->assertTrue($this->isElementPresent("SubjectPACS_1"));
        $this->select("SubjectPACS_1", "label=00.00.00 GENERAL");
        $this->click("browseDownSubjectPACS");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("collId2SubjectPACS_1"));
        $this->click("browseDownSubjectPACS");
        $this->waitForPageToLoad();
        $this->select("SubjectJEL_1", "label=D Microeconomics");
        $this->assertTrue($this->isElementPresent("SubjectJEL_1"));
        $this->click("browseDownSubjectJEL");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("collId2SubjectJEL_1"));
        $this->click("browseDownSubjectJEL");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("collId3SubjectJEL_1"));
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
        $this->assertTrue($this->isElementPresent("Institute_1"));
        $this->select("Institute_1", "label=Technische Universität Hamburg-Harburg");
        $this->click("browseDownInstitute");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("collId2Institute_1"));
        $this->click("browseDownInstitute");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("collId3Institute_1"));
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
        $this->assertTrue($this->isElementPresent("ThesisGrantor_1"));
        $this->select("ThesisGrantor_1", "label=Foobar Universität, Testwissenschaftliche Fakultät");
        $this->assertTrue($this->isElementPresent("ThesisPublisher_1"));
        $this->select("ThesisPublisher_1", "label=Foobar Universitätsbibliothek");
        $this->assertTrue($this->isElementPresent("PersonRefereeFirstName_1"));
        $this->type("PersonRefereeFirstName_1", "Gerd");
        $this->assertTrue($this->isElementPresent("PersonRefereeLastName_1"));
        $this->type("PersonRefereeLastName_1", "Gredo");
        $this->assertTrue($this->isElementPresent("PersonEditorFirstName_1"));
        $this->type("PersonEditorFirstName_1", "Billy");
        $this->assertTrue($this->isElementPresent("PersonEditorLastName_1"));
        $this->type("PersonEditorLastName_1", "Idol");
        $this->assertTrue($this->isElementPresent("PersonAdvisorFirstName_1"));
        $this->type("PersonAdvisorFirstName_1", "Thorsten");
        $this->assertTrue($this->isElementPresent("PersonAdvisorLastName_1"));
        $this->type("PersonAdvisorLastName_1", "Koch");
        $this->assertTrue($this->isElementPresent("PersonTranslatorFirstName_1"));
        $this->type("PersonTranslatorFirstName_1", "Beate");
        $this->assertTrue($this->isElementPresent("PersonTranslatorLastName_1"));
        $this->type("PersonTranslatorLastName_1", "Rusch");
        $this->assertTrue($this->isElementPresent("PersonContributorFirstName_1"));
        $this->type("PersonContributorFirstName_1", "Anja");
        $this->assertTrue($this->isElementPresent("PersonContributorLastName_1"));
        $this->type("PersonContributorLastName_1", "Kammel");
        $this->assertTrue($this->isElementPresent("CreatingCorporation"));
        $this->type("CreatingCorporation", "Zuse Institut Berlin");
        $this->assertTrue($this->isElementPresent("ContributingCorporation"));
        $this->type("ContributingCorporation", "Freie Universität Berlin");
        $this->assertTrue($this->isElementPresent("SubjectSwd_1"));
        $this->type("SubjectSwd_1", "Berlin");
        $this->assertTrue($this->isElementPresent("SubjectUncontrolled_1"));
        $this->type("SubjectUncontrolled_1", "Testen");
        $this->assertTrue($this->isElementPresent("SubjectUncontrolledLanguage_1"));
        $this->assertTrue($this->isElementPresent("Note"));
        $this->type("Note", "Test Test...");
        $this->assertTrue($this->isElementPresent("Licence"));
        $this->select("Licence", "label=Creative Commons - Namensnennung");
        $this->click("LegalNotices");
        $this->click("send");
        $this->waitForPageToLoad();

        // @TODO add assertion that checks if error message is displayed
        $this->type("PersonAuthorDateOfBirth_1", "1965/01/01");
        $this->type("ThesisDateAccepted", "2008/03/19");
        $this->click("send");
        $this->waitForPageToLoad();

        // @TODO add assertion that checks if error message is displayed
        $this->type("PublishedDate", "2010/08/15");
        $this->click("send");
        $this->waitForPageToLoad();

        $this->assertTrue($this->isElementPresent('back'));
        $this->click("back");
        $this->waitForPageToLoad();

        $this->type("ThesisDateAccepted", "2008/03/19");
        $this->click("send");

        $this->waitForPageToLoad();
        $this->click("send");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("link=Go to publish form"));
    }

}

?>
