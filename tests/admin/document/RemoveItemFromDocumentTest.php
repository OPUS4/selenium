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

        $this->openAndWait('/admin/document/edit/id/200/section/persons');

        // Check correct page is shown
        $this->assertElementValueEquals('PersonAuthor-0-Email', 'doe@example.org');

        $this->click("PersonAuthor-0-remove");
        $this->waitForPageToLoad();

        // check confirmation page is shown
        $this->assertTextPresent('Remove \'Person\' from document');
        $this->assertTextPresent('John');
        $this->assertTextPresent('Doe');
        $this->assertTextPresent('doe@example.org');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureyes');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Person' was successfully removed.");

        // Check that no author element is present
        $this->assertElementNotPresent('PersonAuthor-0-remove');
        $this->assertElementNotPresent('PersonAuthor-0-Email');

        $this->afterTest();
    }

    /**
     * Uses person 1.
     */
    public function testCancelRemoveAuthor() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/persons');

        // Check correct page is shown
        $this->assertElementValueEquals('PersonSubmitter-0-AcademicTitle', 'PhD');
        $this->assertTextPresent('Edit Persons');

        $this->click("PersonSubmitter-0-remove");
        $this->waitForPageToLoad();

        // check confirmation page is shown
        $this->assertTextPresent("Remove 'Person' from document");
        $this->assertTextPresent('Jane');
        $this->assertTextPresent('Doe');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureno');
        $this->waitForPageToLoad();

        // Check correct page
        $this->assertTextPresent("'Person' was not removed (cancelled by user).");
        $this->assertTextPresent('Edit Persons');

        // Check correct values
        $this->assertElementValueEquals('PersonSubmitter-0-AcademicTitle', 'PhD');
        $this->assertElementValueEquals('PersonSubmitter-0-FirstName', 'Jane');
        $this->assertElementValueEquals('PersonSubmitter-0-LastName', 'Doe');

        $this->afterTest();
    }

    public function testRemoveTitle() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/titles');

        $this->assertTextPresent('Edit Titles');
        $this->assertElementValueEquals('TitleMain-0-Value', 'KOBV');

        $this->click('TitleMain-0-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Title' from document");
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureyes');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Title' was successfully removed.");
        $this->assertTextPresent('Edit Titles');

        $this->assertElementValueEquals('TitleMain-0-Value', 'COLN');

        $this->afterTest();
    }

    public function testCancelRemoveTitle() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/titles');

        $this->assertTextPresent('Edit Titles');
        $this->assertElementValueEquals('TitleParent-0-Value', 'Parent Title');

        $this->click('TitleParent-0-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Title' from document");
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');
        $this->assertTextPresent('Parent Title');

        $this->click('sureno');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Edit Titles');
        $this->assertElementValueEquals('TitleParent-0-Value', 'Parent Title');

        $this->afterTest();
    }

    public function testRemoveAbstract() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/abstracts');

        $this->assertTextPresent('Edit Abstracts');

        $this->click('TitleAbstract-1-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Abstract' from document");
        $this->assertTextPresent('Lorem impsum.');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureyes');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Abstract' was successfully removed.");
        $this->assertElementNotPresent('TitleAbstract-1-Value');
        $this->assertElementNotPresent('TitleAbstract-1-remove');

        $this->afterTest();
    }

    public function testCancelRemoveAbstract() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/abstracts');

        $this->assertTextPresent('Edit Abstracts');
        $this->assertElementValueEquals('TitleAbstract-0-Value', 'Die KOBV-Zentrale in Berlin-Dahlem.');

        $this->click('TitleAbstract-0-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Abstract' from document");
        $this->assertTextPresent('Die KOBV-Zentrale in Berlin-Dahlem.');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureno');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Abstract' was not removed (cancelled by user).");
        $this->assertTextPresent('Edit Abstracts');
        $this->assertElementValueEquals('TitleAbstract-0-Value', 'Die KOBV-Zentrale in Berlin-Dahlem.');

        $this->afterTest();
    }

    public function testRemoveIdentifier() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/identifiers');

        $this->assertTextPresent('Edit Identifiers');
        $this->assertElementValueEquals('Identifier-1-Type', 'serial');
        $this->assertElementValueEquals('Identifier-1-Value', '123');

        $this->click('Identifier-1-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Identifier' from document");
        $this->assertTextPresent('serial');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureyes');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Identifier' was successfully removed.");
        $this->assertTextPresent('Edit Identifiers');
        $this->assertElementValueEquals('Identifier-1-Type', 'uuid');
        $this->assertElementValueEquals('Identifier-1-Value', '123');

        $this->afterTest();
    }

    public function testCancelRemoveIdentifier() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/identifiers');

        $this->assertTextPresent('Edit Identifiers');
        $this->assertElementValueEquals('Identifier-0-Type', 'old');
        $this->assertElementValueEquals('Identifier-0-Value', '123');

        $this->click('Identifier-0-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Identifier' from document");
        $this->assertTextPresent('old');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureno');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Identifier' was not removed (cancelled by user).");
        $this->assertTextPresent('Edit Identifiers');
        $this->assertElementValueEquals('Identifier-0-Type', 'old');
        $this->assertElementValueEquals('Identifier-0-Value', '123');

        $this->afterTest();
    }

    public function testRemoveSubject() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/subjects');

        $this->assertTextPresent('Edit Subjects');
        $this->assertElementValueEquals('Subject-1-Type', 'uncontrolled');
        $this->assertElementValueEquals('Subject-1-Value', 'Palmöl');

        $this->click('Subject-1-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Subject' from document");
        $this->assertTextPresent('German');
        $this->assertTextPresent('uncontrolled');
        $this->assertTextPresent('Palmöl');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureyes');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Subject' was successfully removed.");
        $this->assertTextPresent('Edit Subjects');
        $this->assertElementNotPresent('Subject-1-Type');
        $this->assertElementNotPresent('Subject-1-remove');

        $this->afterTest();
    }

    public function testCancelRemoveSubject() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/subjects');

        $this->assertTextPresent('Edit Subjects');
        $this->assertElementValueEquals('Subject-0-Type', 'swd');
        $this->assertElementValueEquals('Subject-0-Value', 'Berlin');

        $this->click('Subject-0-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Subject' from document");
        $this->assertTextPresent('German');
        $this->assertTextPresent('swd');
        $this->assertTextPresent('Berlin');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureno');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Subject' was not removed (cancelled by user).");
        $this->assertTextPresent('Edit Subjects');
        $this->assertElementValueEquals('Subject-0-Type', 'swd');
        $this->assertElementValueEquals('Subject-0-Value', 'Berlin');

        $this->afterTest();
    }

    public function testRemoveSeries() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/series');

        $this->assertTextPresent('Edit Series');
        $this->assertElementValueEquals('Series-1-Series', '4');
        $this->assertElementValueEquals('Series-1-Number', '6/6');

        $this->click('Series-1-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Series' from document");
        $this->assertTextPresent('Visible Series');
        $this->assertTextPresent('6/6');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureyes');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Series' was successfully removed.");
        $this->assertTextPresent('Edit Series');
        $this->assertElementNotPresent('Series-1-Series');
        $this->assertElementNotPresent('Series-1-Number');

        $this->afterTest();
    }

    public function testCancelRemoveSeries() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/series');

        $this->assertTextPresent('Edit Series');
        $this->assertElementValueEquals('Series-0-Series', '1');
        $this->assertElementValueEquals('Series-0-Number', '6/6');

        $this->click('Series-0-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Series' from document");
        $this->assertTextPresent('MySeries');
        $this->assertTextPresent('6/6');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureno');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Series' was not removed (cancelled by user).");
        $this->assertTextPresent('Edit Series');
        $this->assertElementValueEquals('Series-0-Series', '1');
        $this->assertElementValueEquals('Series-0-Number', '6/6');

        $this->afterTest();
    }

    public function testRemovePatent() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/patents');

        $this->assertTextPresent('Edit Patents');
        $this->assertElementValueEquals('Patent-1-Number', '4321');

        $this->click('Patent-1-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Patent' from document");
        $this->assertTextPresent('4321');
        $this->assertTextPresent('The bar machine.');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureyes');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Patent' was successfully removed.");
        $this->assertTextPresent('Edit Patents');
        $this->assertElementNotPresent('Patent-1-Number');
        $this->assertElementNotPresent('Patent-1-Application');

        $this->afterTest();
    }

    public function testCancelRemovePatent() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/patents');

        $this->assertTextPresent('Edit Patents');
        $this->assertElementValueEquals('Patent-0-Number', '1234');

        $this->click('Patent-0-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Patent' from document");
        $this->assertTextPresent('1234');
        $this->assertTextPresent('The foo machine.');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureno');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Patent' was not removed (cancelled by user).");
        $this->assertTextPresent('Edit Patents');
        $this->assertElementValueEquals('Patent-0-Number', '1234');
        $this->assertElementValueEquals('Patent-0-Application', 'The foo machine.');

        $this->afterTest();
    }

    public function testRemoveNote() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/notes');

        $this->assertTextPresent('Edit Notes');
        $this->assertElementValueEquals('Note-1-Message', 'Für den Admin');
        $this->assertElementValueEquals('Note-1-Visibility', 'private');

        $this->click('Note-1-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Note' from document");
        $this->assertTextPresent('private');
        $this->assertTextPresent('Für den Admin');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureyes');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Note' was successfully removed.");
        $this->assertTextPresent('Edit Notes');
        $this->assertElementNotPresent('Note-1-Visibility');
        $this->assertElementNotPresent('Note-1-remove');

        $this->afterTest();
    }

    public function testCancelRemoveNote() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/notes');

        $this->assertTextPresent('Edit Notes');
        $this->assertElementValueEquals('Note-0-Message', 'Für die Öffentlichkeit');
        $this->assertElementValueEquals('Note-0-Visibility', 'public');

        $this->click('Note-0-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Note' from document");
        $this->assertTextPresent('public');
        $this->assertTextPresent('Für die Öffentlichkeit');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureno');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Note' was not removed (cancelled by user).");
        $this->assertTextPresent('Edit Notes');
        $this->assertElementValueEquals('Note-0-Message', 'Für die Öffentlichkeit');
        $this->assertElementValueEquals('Note-0-Visibility', 'public');

        $this->afterTest();
    }

    public function testRemoveEnrichment() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/enrichments');

        $this->assertTextPresent('Edit Enrichments');
        $this->assertElementValueEquals('Enrichment-1-Value', 'Berlin');
        $this->assertElementValueEquals('Enrichment-1-KeyName', 'validtestkey');

        $this->click('Enrichment-1-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Enrichment' from document");
        $this->assertTextPresent('Berlin');
        $this->assertTextPresent('validtestkey');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureyes');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Enrichment' was successfully removed.");
        $this->assertTextPresent('Edit Enrichments');
        $this->assertElementNotPresent('Enrichment-1-Value');
        $this->assertElementNotPresent('Enrichment-1-KeyName');

        $this->afterTest();
    }

    public function testCancelRemoveEnrichment() {
        $this->beforeTest();

        $this->openAndWait('/admin/document/edit/id/200/section/enrichments');

        $this->assertTextPresent('Edit Enrichments');
        $this->assertElementValueEquals('Enrichment-0-Value', 'Köln');
        $this->assertElementValueEquals('Enrichment-0-KeyName', 'validtestkey');

        $this->click('Enrichment-0-remove');
        $this->waitForPageToLoad();

        $this->assertTextPresent("Remove 'Enrichment' from document");
        $this->assertTextPresent('validtestkey');
        $this->assertTextPresent('Köln');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureno');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Enrichment' was not removed (cancelled by user).");
        $this->assertTextPresent('Edit Enrichment');
        $this->assertElementValueEquals('Enrichment-0-Value', 'Köln');
        $this->assertElementValueEquals('Enrichment-0-KeyName', 'validtestkey');

        $this->afterTest();
    }

}