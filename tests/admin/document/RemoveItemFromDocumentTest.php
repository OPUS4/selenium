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
        $this->assertElementValueEquals('Persons-author-person0-PersonId', '301');

        $this->click('Persons-author-person0-Remove');
        $this->waitForPageToLoad();

        // Check author has been removed
        $this->assertElementNotPresent('Persons-author-person0-PersonId'); // Keine Autoren übrig
        
        // Save document
        $this->click('save');
        $this->waitForPageToLoad();
        
        $this->assertTextPresent(self::SUCCESS_MESSAGE);

        // Check that no author element is present
        $this->assertElementNotPresent('fieldset-author'); // Keine Autoren übrig

        $this->afterTest();
    }

    public function testRemoveTitle() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Titles-Main-TitleMain0-Value', 'KOBV');

        $this->click('Titles-Main-TitleMain0-Remove');
        $this->waitForPageToLoad();

        $this->assertElementValueEquals('Titles-Main-TitleMain0-Value', 'COLN');
        
        $this->click('save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);

        $this->assertElementContainsText('TitleMain0-element', 'COLN');

        $this->afterTest();
    }

    public function testRemoveAbstract() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Content-Abstracts-TitleAbstract0-Value', 
                'Die KOBV-Zentrale in Berlin-Dahlem.');

        $this->click('Content-Abstracts-TitleAbstract0-Remove');
        $this->waitForPageToLoad();

        $this->assertElementValueEquals('Content-Abstracts-TitleAbstract0-Value', 
                'Lorem impsum.');

        $this->click('save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);

        $this->assertElementContainsText('TitleAbstract0-element', 'Lorem impsum.');

        $this->afterTest();
    }

    public function testRemoveIdentifier() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Identifiers-Identifier1-Type', 'serial');
        $this->assertElementValueEquals('Identifiers-Identifier1-Value', '123');

        $this->click('Identifiers-Identifier1-Remove');
        $this->waitForPageToLoad();

        $this->assertElementValueEquals('Identifiers-Identifier1-Type', 'uuid');
        $this->assertElementValueEquals('Identifiers-Identifier1-Value', '123');

        $this->click('save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);

        $this->assertElementContainsText('Identifier1-element', 'Uuid');
        $this->assertElementContainsText('Identifier1-element', '123');

        $this->afterTest();
    }

    public function testRemoveSubject() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Content-Subjects-Uncontrolled-Subject0-Language', 'deu');
        $this->assertElementValueEquals('Content-Subjects-Uncontrolled-Subject0-Value', 'Palmöl');

        $this->click('Content-Subjects-Uncontrolled-Subject0-Remove');
        $this->waitForPageToLoad();
        
        $this->assertElementNotPresent('Content-Subjects-Uncontrolled-Subject0-Value');

        $this->click('save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);
        $this->assertElementNotPresent('fieldset-Uncontrolled');

        $this->afterTest();
    }

    public function testRemoveSeries() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Series-Series1-SeriesId', '4');
        $this->assertElementValueEquals('Series-Series1-Number', '6/6');

        $this->click('Series-Series1-Remove');
        $this->waitForPageToLoad();

        $this->assertElementNotPresent('Series-Series1-SeriesId');
        
        $this->click('save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);

        $this->assertElementNotPresent('Series1-element');
        $this->assertElementContainsText('Series0-element', 'MySeries');
        $this->assertElementContainsText('Series0-element', '7');

        $this->afterTest();
    }

    public function testRemovePatent() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Patents-Patent1-Number', '4321');

        $this->click('Patents-Patent1-Remove');
        $this->waitForPageToLoad();

        $this->assertElementNotPresent('Patents-Patent1-Number');

        $this->click('save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);
        
        $this->assertElementNotPresent('Patent1-element');
        $this->assertElementContainsText('Patent0-element', 'The foo machine.');
        $this->assertElementContainsText('Patent0-element', '1234');

        $this->afterTest();
    }

    public function testRemoveNote() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Notes-Note1-Message', 'Für den Admin');
        $this->assertElementValueEquals('Notes-Note1-Visibility', 'off');

        $this->click('Notes-Note1-Remove');
        $this->waitForPageToLoad();

        $this->assertElementNotPresent('Notes-Note1-Message');

        $this->click('save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);
        $this->assertElementNotPresent('Note1-element');
        $this->assertElementContainsText('Note0-element', 'Für die Öffentlichkeit');
        $this->assertElementContainsText('Note0-element', 'Public');

        $this->afterTest();
    }

    public function testRemoveEnrichment() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200');

        $this->assertElementValueEquals('Enrichments-Enrichment1-Value', 'Berlin');
        $this->assertElementValueEquals('Enrichments-Enrichment1-KeyName', 'validtestkey');

        $this->click('Enrichments-Enrichment1-Remove');
        $this->waitForPageToLoad();

        $this->assertElementNotPresent('Enrichments-Enrichment1-Value');

        $this->click('save');
        $this->waitForPageToLoad();

        $this->assertTextPresent(self::SUCCESS_MESSAGE);
        $this->assertElementNotPresent('Enrichment1-element');
        $this->assertElementContainsText('Enrichment0-element', 'validtestkey');
        $this->assertElementContainsText('Enrichment0-element', 'Köln');

        $this->afterTest();
    }
    
}