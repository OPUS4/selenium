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
 * @category    Selenium Test
 * @package     Module_Admin
 * @author      Jens Schwidder <schwidder@zib.de>
 * @copyright   Copyright (c) 2008-2011, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class RemoveItemFromDocumentTest extends TestCase {
    
    const SUCCESS_MESSAGE = 'Changes successfully saved.';

    public function beforeTest() {
        $this->switchToEnglish();
        $this->login();
    }

    public function afterTest() {
        $this->logout();
    }

    /**
     * Uses person 0.
     */
    public function testRemoveAuthor() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        // Check correct page is shown
        $this->assertElementValueEquals('Document-Persons-author-AuthorPerson0-PersonId', '301');

        $this->click('Document-Persons-author-AuthorPerson0-Remove');
        $this->waitForPageToLoad();

        // Check author has been removed
        $this->assertElementNotPresent('Document-Persons-author-AuthorPerson0-PersonId'); // Keine Autoren übrig
        
        // Save document
        $this->click('Document-ActionBox-Save');
        $this->waitForPageToLoad();
        
        $this->assertTextPresent(self::SUCCESS_MESSAGE);

        // Check that no author element is present
        $this->assertElementNotPresent('fieldset-author'); // Keine Autoren übrig

        $this->afterTest();
    }

    public function testRemoveTitle() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value', 'KOBV');

        $this->click('Document-Titles-Main-TitleMain0-Remove');
        $this->waitForPageToLoad();

        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value', 'COLN');
        
        $this->click('Document-ActionBox-Save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);

        $this->assertElementContainsText('Document-Titles-Main-TitleMain0-Value', 'COLN');

        $this->afterTest();
    }

    public function testRemoveAbstract() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Document-Content-Abstracts-TitleAbstract0-Value', 
                'Die KOBV-Zentrale in Berlin-Dahlem.');

        $this->click('Document-Content-Abstracts-TitleAbstract0-Remove');
        $this->waitForPageToLoad();

        $this->assertElementValueEquals('Document-Content-Abstracts-TitleAbstract0-Value', 
                'Lorem impsum.');

        $this->click('Document-ActionBox-Save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);

        $this->assertElementContainsText('Document-Content-Abstracts-TitleAbstract0-Value', 'Lorem impsum.');

        $this->afterTest();
    }

    public function testRemoveIdentifier() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Document-Identifiers-Identifier1-Type', 'serial');
        $this->assertElementValueEquals('Document-Identifiers-Identifier1-Value', '123');

        $this->click('Document-Identifiers-Identifier1-Remove');
        $this->waitForPageToLoad();

        $this->assertElementValueEquals('Document-Identifiers-Identifier1-Type', 'uuid');
        $this->assertElementValueEquals('Document-Identifiers-Identifier1-Value', '123');

        $this->click('Document-ActionBox-Save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);

        $this->assertElementContainsText('Document-Identifiers-Identifier1-Type', 'Uuid');
        $this->assertElementContainsText('Document-Identifiers-Identifier1-Value', '123');

        $this->afterTest();
    }

    public function testRemoveSubject() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Document-Content-Subjects-Uncontrolled-Subject0-Language', 'deu');
        $this->assertElementValueEquals('Document-Content-Subjects-Uncontrolled-Subject0-Value', 'Palmöl');

        $this->click('Document-Content-Subjects-Uncontrolled-Subject0-Remove');
        $this->waitForPageToLoad();
        
        $this->assertElementNotPresent('Document-Content-Subjects-Uncontrolled-Subject0-Value');

        $this->click('Document-ActionBox-Save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);
        $this->assertElementNotPresent('fieldset-Uncontrolled');

        $this->afterTest();
    }

    public function testRemoveSeries() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Document-Series-Series1-SeriesId', '4');
        $this->assertElementValueEquals('Document-Series-Series1-Number', '6/6');

        $this->click('Document-Series-Series1-Remove');
        $this->waitForPageToLoad();

        $this->assertElementNotPresent('Document-Series-Series1-SeriesId');
        
        $this->click('Document-ActionBox-Save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);

        $this->assertElementNotPresent('Document-Series-Series1-SeriesId');
        $this->assertElementContainsText('Document-Series-Series0-SeriesId', 'MySeries');
        $this->assertElementContainsText('Document-Series-Series0-Number', '7');

        $this->afterTest();
    }

    public function testRemovePatent() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Document-Patents-Patent1-Number', '4321');

        $this->click('Document-Patents-Patent1-Remove');
        $this->waitForPageToLoad();

        $this->assertElementNotPresent('Document-Patents-Patent1-Number');

        $this->click('Document-ActionBox-Save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);
        
        $this->assertElementNotPresent('Document-Patents-Patent1-Number'); // nur noch ein Patent
        $this->assertElementContainsText('Document-Patents-Patent0-Application', 'The foo machine.');
        $this->assertElementContainsText('Document-Patents-Patent0-Number', '1234');

        $this->afterTest();
    }

    public function testRemoveNote() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Document-Notes-Note1-Message', 'Für den Admin');
        $this->assertElementValueEquals('Document-Notes-Note1-Visibility', 'off');

        $this->click('Document-Notes-Note1-Remove');
        $this->waitForPageToLoad();

        $this->assertElementNotPresent('Document-Notes-Note1-Message');

        $this->click('Document-ActionBox-Save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);
        $this->assertElementNotPresent('Document-Notes-Note1-Message'); // Nur noch eine Notiz
        $this->assertElementContainsText('Document-Notes-Note0-Message', 'Für die Öffentlichkeit');
        $this->assertElementContainsText('Document-Notes-Note0-Visibility', 'Public');

        $this->afterTest();
    }

    public function testRemoveEnrichment() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Document-Enrichments-Enrichment1-Value', 'Berlin');
        $this->assertElementValueEquals('Document-Enrichments-Enrichment1-KeyName', 'validtestkey');

        $this->click('Document-Enrichments-Enrichment1-Remove');
        $this->waitForPageToLoad();

        $this->assertElementNotPresent('Document-Enrichments-Enrichment1-Value');

        $this->click('Document-ActionBox-Save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);
        $this->assertElementNotPresent('Document-Enrichments-Enrichment1-Value');
        $this->assertElementContainsText('Document-Enrichments-Enrichment0-KeyName', 'validtestkey');
        $this->assertElementContainsText('Document-Enrichments-Enrichment0-Value', 'Köln');

        $this->afterTest();
    }
    
}