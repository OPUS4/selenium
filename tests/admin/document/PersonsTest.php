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
 * @copyright   Copyright (c) 2008-2013, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class PersonsTest extends TestCase {

    public function testKeepChangesPersonAddCancel() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/146');

        $this->assertElementPresent('Document-Actions-Id');
        $this->assertElementValueEquals('Document-Actions-Id', 146);
        $this->assertElementPresent('Document-Titles-Main-TitleMain0-Value');
        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value', 'KOBV');

        $this->assertElementPresent('Document-Persons-author-PersonAuthor0-Remove');
        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor1-Remove'); // nur ein Autor

        $this->type('Document-Titles-Main-TitleMain0-Value', 'Neuer Titel');

        $this->clickAndWait('Document-Persons-author-Add');

        $this->assertElementContainsText('//h2', 'Add Person to Document');

        $this->clickAndWait('Cancel');

        $this->assertElementPresent('Document-Actions-Id');
        $this->assertElementValueEquals('Document-Actions-Id', 146);
        $this->assertElementPresent('Document-Titles-Main-TitleMain0-Value');
        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value', 'Neuer Titel');

        $this->assertElementPresent('Document-Persons-author-PersonAuthor0-Remove');
        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor1-Remove'); // nur ein Autor
    }

    public function testPersonAddAndRemove() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/160');

        $this->assertElementPresent('Document-Actions-Id');
        $this->assertElementValueEquals('Document-Actions-Id', 160);
        $this->assertElementPresent('Document-Titles-Main-TitleMain0-Value');
        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value',
            'Dokument mit Datei zum Löschen beim Testen (Selenium)');

        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor0-Remove');

        $this->type('Document-Titles-Main-TitleMain0-Value', 'Neuer Titel');

        $this->clickAndWait('Document-Persons-author-Add');

        $this->assertElementContainsText('//h2', 'Add Person to Document');

        $this->type('LastName', 'Testy');
        $this->type('FirstName', 'John');

        $this->clickAndWait('Save');

        $this->assertElementPresent('Document-Actions-Id');
        $this->assertElementValueEquals('Document-Actions-Id', 160);
        $this->assertElementPresent('Document-Titles-Main-TitleMain0-Value');
        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value', 'Neuer Titel'); // Kept change

        $this->type('Document-Titles-Main-TitleMain0-Value', 'Dokument mit Datei zum Löschen beim Testen (Selenium)');

        $this->assertElementPresent('Document-Persons-author-PersonAuthor0-Remove');
        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor1-Remove'); // nur ein Autor

        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-LastName', 'Testy');
        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-FirstName', 'John');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');

        $this->assertElementPresent('Document-Persons-author-PersonAuthor0-LastName');
        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-LastName', 'Testy');
        $this->assertElementPresent('Document-Persons-author-PersonAuthor0-FirstName');
        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-FirstName', 'John');
        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor1-LastName');

        $this->openAndWait('/admin/document/edit/id/160');

        $this->assertElementPresent('Document-Persons-author-PersonAuthor0-Remove');
        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor1-Remove'); // nur ein Autor

        $this->clickAndWait('Document-Persons-author-PersonAuthor0-Remove');

        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor0-Remove');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');

        $this->assertElementNotPresent('fieldset-Persons');
        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor0-LastName');
    }

    public function testAddTwoPersons() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/160');

        $this->assertElementPresent('Document-Actions-Id');
        $this->assertElementValueEquals('Document-Actions-Id', 160);
        $this->assertElementPresent('Document-Titles-Main-TitleMain0-Value');
        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value',
            'Dokument mit Datei zum Löschen beim Testen (Selenium)');

        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor0-Remove');

        $this->type('Document-Titles-Main-TitleMain0-Value', 'Neuer Titel');

        $this->clickAndWait('Document-Persons-author-Add');

        $this->assertElementContainsText('//h2', 'Add Person to Document');

        $this->type('LastName', 'Testy');
        $this->type('FirstName', 'John');

        $this->clickAndWait('Next');

        $this->assertElementContainsText('//h2', 'Add Person to Document');

        $this->type('LastName', 'Testy2');
        $this->type('FirstName', 'John2');
        $this->select('Document-Role', 'Translator');

        $this->clickAndWait('Save');

        $this->assertElementPresent('Document-Actions-Id');
        $this->assertElementValueEquals('Document-Actions-Id', 160);
        $this->assertElementPresent('Document-Titles-Main-TitleMain0-Value');
        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value', 'Neuer Titel'); // Kept change

        $this->assertElementPresent('Document-Persons-author-PersonAuthor0-Remove');
        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor1-Remove'); // nur ein Autor

        $this->assertElementPresent('Document-Persons-translator-PersonTranslator0-Remove'); //
        $this->assertElementNotPresent('Document-Persons-translator-PersonTranslator1-Remove'); // nur ein Übersetzer

        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-LastName', 'Testy');
        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-FirstName', 'John');

        $this->assertElementContainsText('Document-Persons-translator-PersonTranslator0-LastName', 'Testy2');
        $this->assertElementContainsText('Document-Persons-translator-PersonTranslator0-FirstName', 'John2');

        $this->clickAndWait('Document-ActionBox-Cancel');

        $this->assertElementNotPresent('fieldset-Persons'); // keine Verknüpfung gespeichert
    }

    public function testKeepChangesEditPersonCancel() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/100');

        $this->assertElementValueEquals('Document-Actions-Id', 100);
        $this->assertElementPresent('Document-Persons-author-PersonAuthor0-Remove');
        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor1-Remove');

        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-LastName', 'Doe');
        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-FirstName', 'John');
        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-Email', 'john.doe@example.org');

        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value', 'A very unpublished document.');

        $this->type('Document-Titles-Main-TitleMain0-Value', 'Neuer Titel');

        $this->clickAndWait('Document-Persons-author-PersonAuthor0-Edit');

        $this->assertElementPresent('LastName');
        $this->assertElementValueEquals('LastName', 'Doe');
        $this->assertElementPresent('FirstName');
        $this->assertElementValueEquals('FirstName', 'John');
        $this->assertElementPresent('Email');
        $this->assertElementValueEquals('Email', 'john.doe@example.org');

        $this->clickAndWait('Cancel');

        $this->assertElementValueEquals('Document-Actions-Id', 100);
        $this->assertElementPresent('Document-Persons-author-PersonAuthor0-Remove');
        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor1-Remove');

        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value', 'Neuer Titel');
    }

    public function testEditPerson() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/100');

        $this->assertElementValueEquals('Document-Actions-Id', 100);
        $this->assertElementPresent('Document-Persons-author-PersonAuthor0-Remove');
        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor1-Remove');

        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-LastName', 'Doe');
        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-FirstName', 'John');
        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-Email', 'john.doe@example.org');

        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value', 'A very unpublished document.');

        $this->type('Document-Titles-Main-TitleMain0-Value', 'Neuer Titel');

        $this->clickAndWait('Document-Persons-author-PersonAuthor0-Edit');

        $this->assertElementPresent('LastName');
        $this->assertElementValueEquals('LastName', 'Doe');
        $this->assertElementPresent('FirstName');
        $this->assertElementValueEquals('FirstName', 'John');
        $this->assertElementPresent('Email');
        $this->assertElementValueEquals('Email', 'john.doe@example.org');

        $this->type('AcademicTitle', 'Prof.');
        $this->type('FirstName', 'Jane');
        $this->type('Email', 'jane.doe@example.org');

        $this->clickAndWait('Save');

        $this->assertElementValueEquals('Document-Actions-Id', 100);
        $this->assertElementPresent('Document-Persons-author-PersonAuthor0-Remove');
        $this->assertElementNotPresent('Document-Persons-author-PersonAuthor1-Remove');

        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-AcademicTitle', 'Prof.');
        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-LastName', 'Doe');
        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-FirstName', 'Jane');
        $this->assertElementContainsText('Document-Persons-author-PersonAuthor0-Email', 'jane.doe@example.org');

        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Value', 'Neuer Titel');
    }

}