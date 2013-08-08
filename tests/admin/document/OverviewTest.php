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
 * @category    Unit Test
 * @package     Module_Admin
 * @author      Jens Schwidder <schwidder@zib.de>
 * @copyright   Copyright (c) 2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class OverviewTest extends TestCase {

    /**
     * Test for OPUSVIER-1841.
     */
    public function testRegression1841() {
        $this->switchToEnglish();
        $this->login();

        // Display metadata overview for test document (fully populated)
        $this->openAndWait('/admin/document/index/id/146');

        // Checks
        $this->assertTextNotPresent('Warning:');
        $this->assertTextNotPresent('htmlspecialchars');
        $this->assertTextPresent('1970/01/01');
    }
    
    public function testIndexActionGerman() {
        $this->switchToGerman();
        $this->login();
        
        $this->openAndWait('/admin/document/index/id/146');
        
        // Information in Actionbox
        $this->assertElementContainsText('//*[@id="Document-ServerState"]/dd/ul/li[1]', 'Freigegeben');
        $this->assertElementContainsText('//dd[@id="Document-ServerDatePublished-value"]', '03.01.2012');
        $this->assertElementPresent('//dd[@id="Document-ServerDateModified-value"]');
        $this->assertElementContainsText('//dd[@id="Document-ServerDateModified-value"]', '03.01.2012');
        
        // General
        $this->assertElementContainsText('//*[@id="Document-General-Language"]', 'Deutsch');
        $this->assertElementContainsText('//*[@id="Document-General-Type"]', 'Masterarbeit');
        $this->assertElementContainsText('//*[@id="Document-General-PublishedDate"]', '30.04.2007');
        $this->assertElementContainsText('//*[@id="Document-General-PublishedYear"]', '2008');
        $this->assertElementContainsText('//*[@id="Document-General-CompletedDate"]', '01.12.2011');
        $this->assertElementContainsText('//*[@id="Document-General-CompletedYear"]', '2009');
        
        // Persons
        $this->assertElementContainsText('//*[@id="Document-Persons-author-PersonAuthor0-FirstName"]', 'John');
        $this->assertElementContainsText('//*[@id="Document-Persons-author-PersonAuthor0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-author-PersonAuthor0-Email"]', 'doe@example.org');
        $this->assertElementPresent('//*[@id="Document-Persons-author-PersonAuthor0-AllowContact"]');

        $this->assertElementContainsText('//*[@id="Document-Persons-editor-PersonEditor0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-editor-PersonEditor0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-editor-PersonEditor0-AcademicTitle"]', 'PhD');
        $this->assertElementContainsText('//*[@id="Document-Persons-editor-PersonEditor0-PlaceOfBirth"]', 'London');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-translator-PersonTranslator0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-translator-PersonTranslator0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-translator-PersonTranslator0-AcademicTitle"]', 'PhD');
        $this->assertElementContainsText('//*[@id="Document-Persons-translator-PersonTranslator0-DateOfBirth"]', '01.01.1970');
        $this->assertElementContainsText('//*[@id="Document-Persons-translator-PersonTranslator0-PlaceOfBirth"]', 'New York');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-contributor-PersonContributor0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-contributor-PersonContributor0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-contributor-PersonContributor0-AcademicTitle"]', 'PhD');
        $this->assertElementContainsText('//*[@id="Document-Persons-contributor-PersonContributor0-DateOfBirth"]', '02.01.1970');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-other-PersonOther0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-other-PersonOther0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-other-PersonOther0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-advisor-PersonAdvisor0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-advisor-PersonAdvisor0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-advisor-PersonAdvisor0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-referee-PersonReferee0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-referee-PersonReferee0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-referee-PersonReferee0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-submitter-PersonSubmitter0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-submitter-PersonSubmitter0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-submitter-PersonSubmitter0-AcademicTitle"]', 'PhD');
        
        // Titles
        $this->assertElementContainsText('//*[@id="Document-Titles-Main-TitleMain0-Language"]', 'Deutsch');
        $this->assertElementContainsText('//*[@id="Document-Titles-Main-TitleMain0-Value"]', 'KOBV');
        $this->assertElementContainsText('//*[@id="Document-Titles-Main-TitleMain1-Language"]', 'Englisch');
        $this->assertElementContainsText('//*[@id="Document-Titles-Main-TitleMain1-Value"]', 'COLN');
        
        $this->assertElementContainsText('//*[@id="Document-Titles-Additional-TitleAdditional0-Language"]', 'Deutsch');
        $this->assertElementContainsText('//*[@id="Document-Titles-Additional-TitleAdditional0-Value"]', 
                'Kooperativer Biblioheksverbund Berlin-Brandenburg');
        
        $this->assertElementContainsText('//*[@id="Document-Titles-Parent-TitleParent0-Language"]', 'Deutsch');
        $this->assertElementContainsText('//*[@id="Document-Titles-Parent-TitleParent0-Value"]', 'Parent Title');

        $this->assertElementContainsText('//*[@id="Document-Titles-Sub-TitleSub0-Language"]', 'Deutsch');
        $this->assertElementContainsText('//*[@id="Document-Titles-Sub-TitleSub0-Value"]', 'Service-Zentrale');
        $this->assertElementContainsText('//*[@id="Document-Titles-Sub-TitleSub1-Language"]', 'Englisch');
        $this->assertElementContainsText('//*[@id="Document-Titles-Sub-TitleSub1-Value"]', 'Service Center');
        
        // Bibliographische Informationen
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Edition"]', '1');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Volume"]', '2');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-PublisherName"]', 'Foo Publishing');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-PublisherPlace"]', 'Timbuktu');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-PageCount"]', '4');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-PageFirst"]', '1');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-PageLast"]', '4');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Issue"]', '3');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-ContributingCorporation"]', 'Baz University');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-CreatingCorporation"]', 'Bar University');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-ThesisDateAccepted"]', '02.11.2010');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-ThesisYearAccepted"]', '1999');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-BelongsToBibliography"]', 'Ja');
        
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Publishers-ThesisPublisher0-Institute"]', 'Foobar Universitätsbibliothek');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Publishers-ThesisPublisher1-Institute"]', 'Institute with DNB contact ID');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Grantors-ThesisGrantor0-Institute"]', 'Foobar Universität');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Grantors-ThesisGrantor1-Institute"]', 'School of Life');
        
        // Series
        $this->assertElementContainsText('//*[@id="Document-Series-Series0-SeriesId"]', 'MySeries');
        $this->assertElementContainsText('//*[@id="Document-Series-Series0-Number"]', '5/5');
        $this->assertElementContainsText('//*[@id="Document-Series-Series0-SortOrder"]', '6');
        
        // Enrichments
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment0-KeyName"]', 'validtestkey');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment0-Value"]', 'Köln');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment1-KeyName"]', 'SourceSwb');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment1-Value"]', 'http://www.test.de');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment2-KeyName"]', 'SourceTitle');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment2-Value"]', 'Dieses Dokument ist auch erschienen als ...');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment3-KeyName"]', 'ClassRvk');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment3-Value"]', 'LI 99660');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment4-KeyName"]', 'ContributorsName');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment4-Value"]', 'John Doe (Foreword) and Jane Doe (Illustration)');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment5-KeyName"]', 'Event');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment5-Value"]', 'Opus4 OAI-Event');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment6-KeyName"]', 'City');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment6-Value"]', 'Opus4 OAI-City');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment7-KeyName"]', 'Country');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment7-Value"]', 'Opus4 OAI-Country');
        
        // Collections
        $this->assertElementPresent('//*[@id="Document-Collections-ddc-collection0-Name"]'); // Root Collection hat keinen Namen
        $this->assertElementContainsText('//*[@id="Document-Collections-ddc-collection1-Name"]', '28 Christliche Konfessionen');
        $this->assertElementContainsText('//*[@id="Document-Collections-ddc-collection2-Name"]', '51 Mathematik');
        $this->assertElementContainsText('//*[@id="Document-Collections-ddc-collection3-Name"]', '433 Deutsche Wörterbücher');
        
        $this->assertElementPresent('//*[@id="Document-Collections-ccs-collection0-Name"]', ''); // Root Collection hat keinen Namen
        
        $this->assertElementContainsText('//*[@id="Document-Collections-pacs-collection0-Name"]', '12.15.Hh Determination of Kobayashi-Maskawa matrix elements');
        
        $this->assertElementPresent('//*[@id="Document-Collections-jel-collection0-Name"]'); // Root Collection hat keinen Namen
        
        $this->assertElementContainsText('//*[@id="Document-Collections-msc-collection0-Name"]', '05-XX COMBINATORICS (For finite fields, see 11Txx)');
        
        $this->assertElementContainsText('//*[@id="Document-Collections-bk-collection0-Name"]', '08.20 Geschichte der westlichen Philosophie: Allgemeines');
        
        $this->assertElementContainsText('//*[@id="Document-Collections-institutes-collection0-Name"]', 'Abwasserwirtschaft und Gewässerschutz B-2');
        
        
        // Abstracts
        $this->assertElementContainsText('//*[@id="Document-Content-Abstracts-TitleAbstract0-Language"]', 'Deutsch');
        $this->assertElementContainsText('//*[@id="Document-Content-Abstracts-TitleAbstract0-Value"]', 
                'Die KOBV-Zentrale in Berlin-Dahlem.');
        
        $this->assertElementContainsText('//*[@id="Document-Content-Abstracts-TitleAbstract1-Language"]', 'Englisch');
        $this->assertElementContainsText('//*[@id="Document-Content-Abstracts-TitleAbstract1-Value"]', 
                'Lorem impsum.');
        
        // Subjects
        $this->assertElementContainsText('//*[@id="Document-Content-Subjects-Swd-Subject0-Value"]', 'Berlin');
        
        $this->assertElementContainsText('//*[@id="Document-Content-Subjects-Uncontrolled-Subject0-Language"]', 'Deutsch');
        $this->assertElementContainsText('//*[@id="Document-Content-Subjects-Uncontrolled-Subject0-Value"]', 'Palmöl');
        
        // Identifier
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier0-Type"]', 'alter Identifier');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier0-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier1-Type"]', 'Sequenznummer');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier1-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier2-Type"]', 'Uuid');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier2-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier3-Type"]', 'ISBN');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier3-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier4-Type"]', 'URN');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier4-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier5-Type"]', 'DOI');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier5-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier6-Type"]', 'Handle');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier6-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier7-Type"]', 'URL');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier7-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier8-Type"]', 'ISSN');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier8-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier9-Type"]', 'STD-DOI');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier9-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier10-Type"]', 'CRIS-Link');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier10-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier11-Type"]', 'SplashURL');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier11-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier12-Type"]', 'OPUS 3 Id');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier12-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier13-Type"]', 'Opac Id');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier13-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier14-Type"]', 'Pubmed-Id');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier14-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier15-Type"]', 'ArXiv-Id');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier15-Value"]', '123');
        
        // Lizenzen
        $this->assertElementContainsText('//fieldset[@id="fieldset-Licences"]/legend', 'Lizenzen');
        $this->assertElementContainsText('//*[@id="Document-Licences-licence4"]', 'Creative Commons - Namensnennung');
        
        // Patents
        $this->assertElementContainsText('//*[@id="Document-Patents-Patent0-Number"]', '1234');
        $this->assertElementContainsText('//*[@id="Document-Patents-Patent0-Countries"]', 'DDR');
        $this->assertElementContainsText('//*[@id="Document-Patents-Patent0-YearApplied"]', '1970');
        $this->assertElementContainsText('//*[@id="Document-Patents-Patent0-Application"]', 'The foo machine.');
        $this->assertElementContainsText('//*[@id="Document-Patents-Patent0-DateGranted"]', '01.01.1970');

        // Notes
        $this->assertElementContainsText('//*[@id="Document-Notes-Note0-Visibility"]', 'Öffentlich');
        $this->assertElementContainsText('//*[@id="Document-Notes-Note0-Message"]', 'Für die Öffentlichkeit');
        $this->assertElementNotPresent('//*[@id="Document-Notes-Note1-Visibility"]');
        $this->assertElementContainsText('//*[@id="Document-Notes-Note1-Message"]', 'Für den Admin');
    }
    
    public function testIndexActionEnglish() {
        $this->switchToEnglish();
        $this->login();
        
        $this->openAndWait('/admin/document/index/id/146');
        
        // Information in Actionbox
        $this->assertElementContainsText('//*[@id="Document-ServerState"]/dd/ul/li[1]', 'Published');
        $this->assertElementContainsText('//dd[@id="Document-ServerDatePublished-value"]', '2012/01/03');
        $this->assertElementPresent('//dd[@id="Document-ServerDateModified-value"]');
        $this->assertElementContainsText('//dd[@id="Document-ServerDateModified-value"]', '2012/01/03');
        
        // General
        $this->assertElementContainsText('//*[@id="Document-General-Language"]', 'German');
        $this->assertElementContainsText('//*[@id="Document-General-Type"]', 'Master\'s Thesis');
        $this->assertElementContainsText('//*[@id="Document-General-PublishedDate"]', '2007/04/30');
        $this->assertElementContainsText('//*[@id="Document-General-PublishedYear"]', '2008');
        $this->assertElementContainsText('//*[@id="Document-General-CompletedDate"]', '2011/12/01');
        $this->assertElementContainsText('//*[@id="Document-General-CompletedYear"]', '2009');
        
        // Persons
        $this->assertElementContainsText('//*[@id="Document-Persons-author-PersonAuthor0-FirstName"]', 'John');
        $this->assertElementContainsText('//*[@id="Document-Persons-author-PersonAuthor0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-author-PersonAuthor0-Email"]', 'doe@example.org');
        $this->assertElementNotPresent('//*[@id="Document-Persons-author-PersonAuthor0-DateOfBirth"]');
        $this->assertElementNotPresent('//*[@id="Document-Persons-author-PersonAuthor0-PlaceOfBirth"]');
        $this->assertElementPresent('//*[@id="Document-Persons-author-PersonAuthor0-AllowContact"]');

        $this->assertElementContainsText('//*[@id="Document-Persons-editor-PersonEditor0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-editor-PersonEditor0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-editor-PersonEditor0-AcademicTitle"]', 'PhD');
        $this->assertElementContainsText('//*[@id="Document-Persons-editor-PersonEditor0-PlaceOfBirth"]', 'London');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-translator-PersonTranslator0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-translator-PersonTranslator0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-translator-PersonTranslator0-AcademicTitle"]', 'PhD');
        $this->assertElementContainsText('//*[@id="Document-Persons-translator-PersonTranslator0-DateOfBirth"]', '1970/01/01');
        $this->assertElementContainsText('//*[@id="Document-Persons-translator-PersonTranslator0-PlaceOfBirth"]', 'New York');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-contributor-PersonContributor0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-contributor-PersonContributor0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-contributor-PersonContributor0-AcademicTitle"]', 'PhD');
        $this->assertElementContainsText('//*[@id="Document-Persons-contributor-PersonContributor0-DateOfBirth"]', '1970/01/02');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-other-PersonOther0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-other-PersonOther0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-other-PersonOther0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-advisor-PersonAdvisor0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-advisor-PersonAdvisor0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-advisor-PersonAdvisor0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-referee-PersonReferee0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-referee-PersonReferee0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-referee-PersonReferee0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//*[@id="Document-Persons-submitter-PersonSubmitter0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//*[@id="Document-Persons-submitter-PersonSubmitter0-LastName"]', 'Doe');
        $this->assertElementContainsText('//*[@id="Document-Persons-submitter-PersonSubmitter0-AcademicTitle"]', 'PhD');
        
        // Titles
        $this->assertElementContainsText('//*[@id="Document-Titles-Main-TitleMain0-Language"]', 'German');
        $this->assertElementContainsText('//*[@id="Document-Titles-Main-TitleMain0-Value"]', 'KOBV');
        $this->assertElementContainsText('//*[@id="Document-Titles-Main-TitleMain1-Language"]', 'English');
        $this->assertElementContainsText('//*[@id="Document-Titles-Main-TitleMain1-Value"]', 'COLN');
        
        $this->assertElementContainsText('//*[@id="Document-Titles-Additional-TitleAdditional0-Language"]', 'German');
        $this->assertElementContainsText('//*[@id="Document-Titles-Additional-TitleAdditional0-Value"]', 
                'Kooperativer Biblioheksverbund Berlin-Brandenburg');
        
        $this->assertElementContainsText('//*[@id="Document-Titles-Parent-TitleParent0-Language"]', 'German');
        $this->assertElementContainsText('//*[@id="Document-Titles-Parent-TitleParent0-Value"]', 'Parent Title');

        $this->assertElementContainsText('//*[@id="Document-Titles-Sub-TitleSub0-Language"]', 'German');
        $this->assertElementContainsText('//*[@id="Document-Titles-Sub-TitleSub0-Value"]', 'Service-Zentrale');
        $this->assertElementContainsText('//*[@id="Document-Titles-Sub-TitleSub1-Language"]', 'English');
        $this->assertElementContainsText('//*[@id="Document-Titles-Sub-TitleSub1-Value"]', 'Service Center');
        
        // Bibliographische Informationen
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Edition"]', '1');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Volume"]', '2');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-PublisherName"]', 'Foo Publishing');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-PublisherPlace"]', 'Timbuktu');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-PageCount"]', '4');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-PageFirst"]', '1');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-PageLast"]', '4');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Issue"]', '3');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-ContributingCorporation"]', 'Baz University');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-CreatingCorporation"]', 'Bar University');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-ThesisDateAccepted"]', '2010/11/02');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-ThesisYearAccepted"]', '1999');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-BelongsToBibliography"]', 'Yes');
        
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Publishers-ThesisPublisher0-Institute"]', 'Foobar Universitätsbibliothek');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Publishers-ThesisPublisher1-Institute"]', 'Institute with DNB contact ID');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Grantors-ThesisGrantor0-Institute"]', 'Foobar Universität');
        $this->assertElementContainsText('//*[@id="Document-Bibliographic-Grantors-ThesisGrantor1-Institute"]', 'School of Life');
        
        // Series
        $this->assertElementContainsText('//*[@id="Document-Series-Series0-SeriesId"]', 'MySeries');
        $this->assertElementContainsText('//*[@id="Document-Series-Series0-Number"]', '5/5');
        $this->assertElementContainsText('//*[@id="Document-Series-Series0-SortOrder"]', '6');
        
        // Enrichments
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment0-KeyName"]', 'validtestkey');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment0-Value"]', 'Köln');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment1-KeyName"]', 'SourceSwb');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment1-Value"]', 'http://www.test.de');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment2-KeyName"]', 'SourceTitle');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment2-Value"]', 'Dieses Dokument ist auch erschienen als ...');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment3-KeyName"]', 'ClassRvk');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment3-Value"]', 'LI 99660');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment4-KeyName"]', 'ContributorsName');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment4-Value"]', 'John Doe (Foreword) and Jane Doe (Illustration)');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment5-KeyName"]', 'Event');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment5-Value"]', 'Opus4 OAI-Event');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment6-KeyName"]', 'City');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment6-Value"]', 'Opus4 OAI-City');
        
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment7-KeyName"]', 'Country');
        $this->assertElementContainsText('//*[@id="Document-Enrichments-Enrichment7-Value"]', 'Opus4 OAI-Country');
        
        // Collections
        $this->assertElementPresent('//*[@id="Document-Collections-ddc-collection0-Name"]'); // Root Collection hat keinen Namen
        $this->assertElementContainsText('//*[@id="Document-Collections-ddc-collection1-Name"]', '28 Christliche Konfessionen');
        $this->assertElementContainsText('//*[@id="Document-Collections-ddc-collection2-Name"]', '51 Mathematik');
        $this->assertElementContainsText('//*[@id="Document-Collections-ddc-collection3-Name"]', '433 Deutsche Wörterbücher');
        
        $this->assertElementPresent('//*[@id="Document-Collections-ccs-collection0-Name"]', ''); // Root Collection hat keinen Namen
        
        $this->assertElementContainsText('//*[@id="Document-Collections-pacs-collection0-Name"]', '12.15.Hh Determination of Kobayashi-Maskawa matrix elements');
        
        $this->assertElementPresent('//*[@id="Document-Collections-jel-collection0-Name"]'); // Root Collection hat keinen Namen
        
        $this->assertElementContainsText('//*[@id="Document-Collections-msc-collection0-Name"]', '05-XX COMBINATORICS (For finite fields, see 11Txx)');
        
        $this->assertElementContainsText('//*[@id="Document-Collections-bk-collection0-Name"]', '08.20 Geschichte der westlichen Philosophie: Allgemeines');
        
        $this->assertElementContainsText('//*[@id="Document-Collections-institutes-collection0-Name"]', 'Abwasserwirtschaft und Gewässerschutz B-2');
        
        
        // Abstracts
        $this->assertElementContainsText('//*[@id="Document-Content-Abstracts-TitleAbstract0-Language"]', 'German');
        $this->assertElementContainsText('//*[@id="Document-Content-Abstracts-TitleAbstract0-Value"]', 
                'Die KOBV-Zentrale in Berlin-Dahlem.');
        
        $this->assertElementContainsText('//*[@id="Document-Content-Abstracts-TitleAbstract1-Language"]', 'English');
        $this->assertElementContainsText('//*[@id="Document-Content-Abstracts-TitleAbstract1-Value"]', 
                'Lorem impsum.');
        
        // Subjects
        $this->assertElementContainsText('//*[@id="Document-Content-Subjects-Swd-Subject0-Value"]', 'Berlin');
        
        $this->assertElementContainsText('//*[@id="Document-Content-Subjects-Uncontrolled-Subject0-Language"]', 'German');
        $this->assertElementContainsText('//*[@id="Document-Content-Subjects-Uncontrolled-Subject0-Value"]', 'Palmöl');
        
        // Identifier
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier0-Type"]', 'old Identifier');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier0-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier1-Type"]', 'Serial Number');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier1-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier2-Type"]', 'Uuid');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier2-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier3-Type"]', 'ISBN');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier3-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier4-Type"]', 'URN');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier4-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier5-Type"]', 'DOI');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier5-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier6-Type"]', 'Handle');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier6-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier7-Type"]', 'URL');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier7-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier8-Type"]', 'ISSN');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier8-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier9-Type"]', 'STD-DOI');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier9-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier10-Type"]', 'CRIS-Link');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier10-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier11-Type"]', 'SplashURL');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier11-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier12-Type"]', 'Opus3 Id');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier12-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier13-Type"]', 'Opac Id');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier13-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier14-Type"]', 'Pubmed Id');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier14-Value"]', '123');
        
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier15-Type"]', 'ArXiv Id');
        $this->assertElementContainsText('//*[@id="Document-Identifiers-Identifier15-Value"]', '123');
        
        // Lizenzen (Name der Lizenz nicht übersetzt)
        $this->assertElementContainsText('//fieldset[@id="fieldset-Licences"]/legend', 'Licences');
        $this->assertElementContainsText('//*[@id="Document-Licences-licence4"]', 'Creative Commons - Namensnennung'); 
        
        // Patents
        $this->assertElementContainsText('//*[@id="Document-Patents-Patent0-Number"]', '1234');
        $this->assertElementContainsText('//*[@id="Document-Patents-Patent0-Countries"]', 'DDR');
        $this->assertElementContainsText('//*[@id="Document-Patents-Patent0-YearApplied"]', '1970');
        $this->assertElementContainsText('//*[@id="Document-Patents-Patent0-Application"]', 'The foo machine.');
        $this->assertElementContainsText('//*[@id="Document-Patents-Patent0-DateGranted"]', '1970/01/01');

        // Notes
        $this->assertElementContainsText('//*[@id="Document-Notes-Note0-Visibility"]', 'Public');
        $this->assertElementContainsText('//*[@id="Document-Notes-Note0-Message"]', 'Für die Öffentlichkeit');
        $this->assertElementNotPresent('//*[@id="Document-Notes-Note1-Visibility"]');
        $this->assertElementContainsText('//*[@id="Document-Notes-Note1-Message"]', 'Für den Admin');
    }

}