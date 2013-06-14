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
        
        // Lizenzen
        $this->assertElementContainsText('//fieldset[@id="fieldset-Licences"]/legend', 'Lizenzen');
        $this->assertElementContainsText('//dt[@id="Document-Licences-licence4"]', 'Creative Commons - Namensnennung');
    }
    
    public function testIndexActionEnglish() {
        $this->switchToEnglish();
        $this->login();
        
        $this->openAndWait('/admin/document/index/id/146');
        
        // Information in Actionbox
        $this->assertElementContainsText('//dd[@id="Document-ServerState"]', 'Published');
        $this->assertElementContainsText('//dd[@id="Document-ServerDatePublished"]', '2012/01/03');
        $this->assertElementContainsText('//dd[@id="Document-ServerDateModified"]', '2012/01/03');
        
        // General
        $this->assertElementContainsText('//dd[@id="Document-General-Language"]', 'German');
        $this->assertElementContainsText('//dd[@id="Document-General-Type"]', 'Master\'s Thesis');
        $this->assertElementContainsText('//dd[@id="Document-General-PublishedDate"]', '2007/04/30');
        $this->assertElementContainsText('//dd[@id="Document-General-PublishedYear"]', '2008');
        $this->assertElementContainsText('//dd[@id="Document-General-CompletedDate"]', '2011/12/01');
        $this->assertElementContainsText('//dd[@id="Document-General-CompletedYear"]', '2009');
        
        // Persons
        $this->assertElementContainsText('//span[@id="Document-Persons-author-Person0-FirstName"]', 'John');
        $this->assertElementContainsText('//span[@id="Document-Persons-author-Person0-LastName"]', 'Doe');
        $this->assertElementContainsText('//span[@id="Document-Persons-author-Person0-Email"]', 'doe@example.org');
        $this->assertElementContainsText('//dt[@id="Document-Persons-author-Person0-AllowContact"]', 'E-Mail contact allowed');

        $this->assertElementContainsText('//span[@id="Document-Persons-editor-Person0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//span[@id="Document-Persons-editor-Person0-LastName"]', 'Doe');
        $this->assertElementContainsText('//span[@id="Document-Persons-editor-Person0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//span[@id="Document-Persons-translator-Person0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//span[@id="Document-Persons-translator-Person0-LastName"]', 'Doe');
        $this->assertElementContainsText('//span[@id="Document-Persons-translator-Person0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//span[@id="Document-Persons-contributor-Person0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//span[@id="Document-Persons-contributor-Person0-LastName"]', 'Doe');
        $this->assertElementContainsText('//span[@id="Document-Persons-contributor-Person0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//span[@id="Document-Persons-other-Person0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//span[@id="Document-Persons-other-Person0-LastName"]', 'Doe');
        $this->assertElementContainsText('//span[@id="Document-Persons-other-Person0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//span[@id="Document-Persons-advisor-Person0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//span[@id="Document-Persons-advisor-Person0-LastName"]', 'Doe');
        $this->assertElementContainsText('//span[@id="Document-Persons-advisor-Person0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//span[@id="Document-Persons-referee-Person0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//span[@id="Document-Persons-referee-Person0-LastName"]', 'Doe');
        $this->assertElementContainsText('//span[@id="Document-Persons-referee-Person0-AcademicTitle"]', 'PhD');
        
        $this->assertElementContainsText('//span[@id="Document-Persons-submitter-Person0-FirstName"]', 'Jane');
        $this->assertElementContainsText('//span[@id="Document-Persons-submitter-Person0-LastName"]', 'Doe');
        $this->assertElementContainsText('//span[@id="Document-Persons-submitter-Person0-AcademicTitle"]', 'PhD');
        
        // Titles
        $this->assertElementContainsText('//dd[@id="Document-Titles-Main-TitleMain0-Language"]', 'German');
        $this->assertElementContainsText('//dd[@id="Document-Titles-Main-TitleMain0-Value"]', 'KOBV');
        $this->assertElementContainsText('//dd[@id="Document-Titles-Main-TitleMain1-Language"]', 'English');
        $this->assertElementContainsText('//dd[@id="Document-Titles-Main-TitleMain1-Value"]', 'COLN');
        
        $this->assertElementContainsText('//dd[@id="Document-Titles-Additional-TitleAdditional0-Language"]', 'German');
        $this->assertElementContainsText('//dd[@id="Document-Titles-Additional-TitleAdditional0-Value"]', 
                'Kooperativer Biblioheksverbund Berlin-Brandenburg');
        
        $this->assertElementContainsText('//dd[@id="Document-Titles-Parent-TitleParent0-Language"]', 'German');
        $this->assertElementContainsText('//dd[@id="Document-Titles-Parent-TitleParent0-Value"]', 'Parent Title');

        $this->assertElementContainsText('//dd[@id="Document-Titles-Sub-TitleSub0-Language"]', 'German');
        $this->assertElementContainsText('//dd[@id="Document-Titles-Sub-TitleSub0-Value"]', 'Service-Zentrale');
        $this->assertElementContainsText('//dd[@id="Document-Titles-Sub-TitleSub1-Language"]', 'English');
        $this->assertElementContainsText('//dd[@id="Document-Titles-Sub-TitleSub1-Value"]', 'Service Center');
        
        // Bibliographische Informationen
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-Edition"]', '1');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-Volume"]', '2');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-PublisherName"]', 'Foo Publishing');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-PublisherPlace"]', 'Timbuktu');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-PageCount"]', '4');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-PageFirst"]', '1');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-PageLast"]', '4');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-Issue"]', '3');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-ContributingCorporation"]', 'Baz University');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-CreatingCorporation"]', 'Bar University');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-ThesisDateAccepted"]', '2010/11/02');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-ThesisYearAccepted"]', '1999');
        $this->assertElementContainsText('//dt[@id="Document-Bibliographic-BelongsToBibliography"]', 'Belongs to Bibliography');
        
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-Publishers-ThesisPublisher0-Institute"]', 'Foobar Universitätsbibliothek');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-Publishers-ThesisPublisher1-Institute"]', 'Institute with DNB contact ID');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-Grantors-ThesisGrantor0-Institute"]', 'Foobar Universität');
        $this->assertElementContainsText('//dd[@id="Document-Bibliographic-Grantors-ThesisGrantor1-Institute"]', 'School of Life');
        
        // Series
        $this->assertElementContainsText('//dd[@id="Document-Series-Series0-SeriesId"]', 'MySeries');
        $this->assertElementContainsText('//dd[@id="Document-Series-Series0-Number"]', '5/5');
        $this->assertElementContainsText('//dd[@id="Document-Series-Series0-SortOrder"]', '6');
        
        // Enrichments
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment0-KeyName"]', 'validtestkey');
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment0-Value"]', 'Köln');
        
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment1-KeyName"]', 'SourceSwb');
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment1-Value"]', 'http://www.test.de');
        
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment2-KeyName"]', 'SourceTitle');
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment2-Value"]', 'Dieses Dokument ist auch erschienen als ...');
        
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment3-KeyName"]', 'ClassRvk');
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment3-Value"]', 'LI 99660');
        
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment4-KeyName"]', 'ContributorsName');
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment4-Value"]', 'John Doe (Foreword) and Jane Doe (Illustration)');
        
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment5-KeyName"]', 'Event');
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment5-Value"]', 'Opus4 OAI-Event');
        
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment6-KeyName"]', 'City');
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment6-Value"]', 'Opus4 OAI-City');
        
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment7-KeyName"]', 'Country');
        $this->assertElementContainsText('//dd[@id="Document-Enrichments-Enrichment7-Value"]', 'Opus4 OAI-Country');
        
        // Collections TODO
        
        // Abstracts
        $this->assertElementContainsText('//dd[@id="Document-Content-Abstracts-TitleAbstract0-Language"]', 'German');
        $this->assertElementContainsText('//dd[@id="Document-Content-Abstracts-TitleAbstract0-Value"]', 
                'Die KOBV-Zentrale in Berlin-Dahlem.');
        
        $this->assertElementContainsText('//dd[@id="Document-Content-Abstracts-TitleAbstract1-Language"]', 'English');
        $this->assertElementContainsText('//dd[@id="Document-Content-Abstracts-TitleAbstract1-Value"]', 
                'Lorem impsum.');
        
        // Subjects
        $this->assertElementContainsText('//dd[@id="Document-Content-Subjects-Swd-Subject0-Value"]', 'Berlin');
        
        $this->assertElementContainsText('//dd[@id="Document-Content-Subjects-Uncontrolled-Subject0-Language"]', 'German');
        $this->assertElementContainsText('//dd[@id="Document-Content-Subjects-Uncontrolled-Subject0-Value"]', 'Palmöl');
        
        // Identifier
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier0-Type"]', 'old Identifier');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier0-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier1-Type"]', 'Serial Number');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier1-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier2-Type"]', 'Uuid');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier2-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier3-Type"]', 'ISBN');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier3-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier4-Type"]', 'URN');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier4-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier5-Type"]', 'DOI');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier5-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier6-Type"]', 'Handle');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier6-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier7-Type"]', 'URL');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier7-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier8-Type"]', 'ISSN');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier8-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier9-Type"]', 'STD-DOI');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier9-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier10-Type"]', 'CRIS-Link');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier10-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier11-Type"]', 'SplashURL');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier11-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier12-Type"]', 'Opus3 Id');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier12-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier13-Type"]', 'Opac Id');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier13-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier14-Type"]', 'Pubmed Id');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier14-Value"]', '123');
        
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier15-Type"]', 'ArXiv Id');
        $this->assertElementContainsText('//dd[@id="Document-Identifiers-Identifier15-Value"]', '123');
        
        // Lizenzen (Name der Lizenz nicht übersetzt)
        $this->assertElementContainsText('//fieldset[@id="fieldset-Licences"]/legend', 'Licences');
        $this->assertElementContainsText('//dt[@id="Document-Licences-licence4"]', 'Creative Commons - Namensnennung'); 
        
        // Patents
        $this->assertElementContainsText('//dd[@id="Document-Patents-Patent0-Number"]', '1234');
        $this->assertElementContainsText('//dd[@id="Document-Patents-Patent0-Countries"]', 'DDR');
        $this->assertElementContainsText('//dd[@id="Document-Patents-Patent0-YearApplied"]', '1970');
        $this->assertElementContainsText('//dd[@id="Document-Patents-Patent0-Application"]', 'The foo machine.');
        $this->assertElementContainsText('//dd[@id="Document-Patents-Patent0-DateGranted"]', '1970/01/01');

        // Notes
        $this->assertElementContainsText('//dt[@id="Document-Notes-Note0-Visibility"]', 'Public');
        $this->assertElementContainsText('//dd[@id="Document-Notes-Note0-Message"]', 'Für die Öffentlichkeit');
        $this->assertElementNotPresent('//dt[@id="Document-Notes-Note1-Visibility"]');
        $this->assertElementContainsText('//dd[@id="Document-Notes-Note1-Message"]', 'Für den Admin');
    }

}