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

class SubjectsTest extends TestCase {

    public function testModifySubjectGND() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');

        $this->assertElementNotPresent('Document-Content-Subjects-Swd-Subject0-Value');

        $this->clickAndWait('Document-Content-Subjects-Swd-Add');

        $this->assertElementPresent('Document-Content-Subjects-Swd-Subject0-Value');
        $this->assertElementNotPresent('Document-Content-Subjects-Swd-Subject1-Value');

        $this->clickAndWait('Document-Content-Subjects-Swd-Add');

        $this->assertElementPresent('Document-Content-Subjects-Swd-Subject0-Value');
        $this->assertElementPresent('Document-Content-Subjects-Swd-Subject1-Value');

        $this->type('Document-Content-Subjects-Swd-Subject0-Value', 'Eins');
        $this->type('Document-Content-Subjects-Swd-Subject0-ExternalKey', 'Eins-Key');
        $this->type('Document-Content-Subjects-Swd-Subject1-Value', 'Eins'); // wiederholtes Schlagwort
        $this->type('Document-Content-Subjects-Swd-Subject1-ExternalKey', '546');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//*[@id="actionboxContainer"]//*[@class="messages"]',
            'Document cannot be saved, because some input is not valid.');
        $this->assertElementContainsText(
            '//td[@id="Document-Content-Subjects-Swd-Subject1-Value-element"]/ul[@class="errors"]/li',
            'Subject already assigned.');

        $this->type('Document-Content-Subjects-Swd-Subject1-Value', 'Zwei');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementContainsText('Document-Content-Subjects-Swd-Subject0-Value', 'Eins');
        $this->assertElementContainsText('Document-Content-Subjects-Swd-Subject0-ExternalKey', 'Eins-Key');
        $this->assertElementContainsText('Document-Content-Subjects-Swd-Subject1-Value', 'Zwei');
        $this->assertElementContainsText('Document-Content-Subjects-Swd-Subject1-ExternalKey', '546');

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementValueEquals('Document-Content-Subjects-Swd-Subject0-Value', 'Eins');
        $this->assertElementValueEquals('Document-Content-Subjects-Swd-Subject0-ExternalKey', 'Eins-Key');
        $this->assertElementValueEquals('Document-Content-Subjects-Swd-Subject1-Value', 'Zwei');
        $this->assertElementValueEquals('Document-Content-Subjects-Swd-Subject1-ExternalKey', '546');

        $this->clickAndWait('Document-Content-Subjects-Swd-Subject0-Remove');

        $this->assertElementValueEquals('Document-Content-Subjects-Swd-Subject0-Value', 'Zwei');
        $this->assertElementValueEquals('Document-Content-Subjects-Swd-Subject0-ExternalKey', '546');
        $this->assertElementNotPresent('Document-Content-Subjects-Swd-Subject1-Value');

        $this->clickAndWait('Document-Content-Subjects-Swd-Subject0-Remove');

        $this->assertElementNotPresent('Document-Content-Subjects-Swd-Subject0-Value');
        $this->assertElementNotPresent('Document-Content-Subjects-Swd-Subject1-Value');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementNotPresent('Document-Content-Subjects-Swd-Subject0-Value');
        $this->assertElementNotPresent('Document-Content-Subjects-Swd-Subject1-Value');
    }

    public function testModifySubjectPsyndex() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');

        $this->assertElementNotPresent('Document-Content-Subjects-Psyndex-Subject0-Value');

        $this->clickAndWait('Document-Content-Subjects-Psyndex-Add');

        $this->assertElementPresent('Document-Content-Subjects-Psyndex-Subject0-Value');
        $this->assertElementNotPresent('Document-Content-Subjects-Psyndex-Subject1-Value');

        $this->clickAndWait('Document-Content-Subjects-Psyndex-Add');

        $this->assertElementPresent('Document-Content-Subjects-Psyndex-Subject0-Value');
        $this->assertElementPresent('Document-Content-Subjects-Psyndex-Subject1-Value');

        $this->select('Document-Content-Subjects-Psyndex-Subject0-Language', 'German');
        $this->type('Document-Content-Subjects-Psyndex-Subject0-Value', 'Eins');
        $this->type('Document-Content-Subjects-Psyndex-Subject0-ExternalKey', 'Eins-Key');
        $this->select('Document-Content-Subjects-Psyndex-Subject1-Language', 'German');
        $this->type('Document-Content-Subjects-Psyndex-Subject1-Value', 'Eins'); // wiederholtes Schlagwort
        $this->type('Document-Content-Subjects-Psyndex-Subject1-ExternalKey', '546');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//*[@id="actionboxContainer"]//*[@class="messages"]',
            'Document cannot be saved, because some input is not valid.');
        $this->assertElementContainsText(
            '//td[@id="Document-Content-Subjects-Psyndex-Subject1-Value-element"]/ul[@class="errors"]/li',
            'Subject already assigned.');

        $this->select('Document-Content-Subjects-Psyndex-Subject1-Language', 'English');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementContainsText('Document-Content-Subjects-Psyndex-Subject0-Language', 'German');
        $this->assertElementContainsText('Document-Content-Subjects-Psyndex-Subject0-Value', 'Eins');
        $this->assertElementContainsText('Document-Content-Subjects-Psyndex-Subject0-ExternalKey', 'Eins-Key');
        $this->assertElementContainsText('Document-Content-Subjects-Psyndex-Subject1-Language', 'English');
        $this->assertElementContainsText('Document-Content-Subjects-Psyndex-Subject1-Value', 'Eins');
        $this->assertElementContainsText('Document-Content-Subjects-Psyndex-Subject1-ExternalKey', '546');

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementValueEquals('Document-Content-Subjects-Psyndex-Subject0-Language', 'deu');
        $this->assertElementValueEquals('Document-Content-Subjects-Psyndex-Subject0-Value', 'Eins');
        $this->assertElementValueEquals('Document-Content-Subjects-Psyndex-Subject0-ExternalKey', 'Eins-Key');
        $this->assertElementValueEquals('Document-Content-Subjects-Psyndex-Subject1-Language', 'eng');
        $this->assertElementValueEquals('Document-Content-Subjects-Psyndex-Subject1-Value', 'Eins');
        $this->assertElementValueEquals('Document-Content-Subjects-Psyndex-Subject1-ExternalKey', '546');

        $this->clickAndWait('Document-Content-Subjects-Psyndex-Subject0-Remove');

        $this->assertElementValueEquals('Document-Content-Subjects-Psyndex-Subject0-Language', 'eng');
        $this->assertElementValueEquals('Document-Content-Subjects-Psyndex-Subject0-Value', 'Eins');
        $this->assertElementValueEquals('Document-Content-Subjects-Psyndex-Subject0-ExternalKey', '546');
        $this->assertElementNotPresent('Document-Content-Subjects-Psyndex-Subject1-Value');

        $this->clickAndWait('Document-Content-Subjects-Psyndex-Subject0-Remove');

        $this->assertElementNotPresent('Document-Content-Subjects-Psyndex-Subject0-Value');
        $this->assertElementNotPresent('Document-Content-Subjects-Psyndex-Subject1-Value');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementNotPresent('Document-Content-Subjects-Psyndex-Subject0-Value');
        $this->assertElementNotPresent('Document-Content-Subjects-Psyndex-Subject1-Value');
    }

    public function testModifySubjectUncontrolled() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');

        $this->assertElementNotPresent('Document-Content-Subjects-Uncontrolled-Subject0-Value');

        $this->clickAndWait('Document-Content-Subjects-Uncontrolled-Add');

        $this->assertElementPresent('Document-Content-Subjects-Uncontrolled-Subject0-Value');
        $this->assertElementNotPresent('Document-Content-Subjects-Uncontrolled-Subject1-Value');

        $this->clickAndWait('Document-Content-Subjects-Uncontrolled-Add');

        $this->assertElementPresent('Document-Content-Subjects-Uncontrolled-Subject0-Value');
        $this->assertElementPresent('Document-Content-Subjects-Uncontrolled-Subject1-Value');

        $this->select('Document-Content-Subjects-Uncontrolled-Subject0-Language', 'German');
        $this->type('Document-Content-Subjects-Uncontrolled-Subject0-Value', 'Eins');
        $this->type('Document-Content-Subjects-Uncontrolled-Subject0-ExternalKey', 'Eins-Key');
        $this->select('Document-Content-Subjects-Uncontrolled-Subject1-Language', 'German');
        $this->type('Document-Content-Subjects-Uncontrolled-Subject1-Value', 'Eins'); // wiederholtes Schlagwort
        $this->type('Document-Content-Subjects-Uncontrolled-Subject1-ExternalKey', '546');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//*[@id="actionboxContainer"]//*[@class="messages"]',
            'Document cannot be saved, because some input is not valid.');
        $this->assertElementContainsText(
            '//td[@id="Document-Content-Subjects-Uncontrolled-Subject1-Value-element"]/ul[@class="errors"]/li',
            'Subject already assigned.');

        $this->select('Document-Content-Subjects-Uncontrolled-Subject1-Language', 'English');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementContainsText('Document-Content-Subjects-Uncontrolled-Subject0-Language', 'German');
        $this->assertElementContainsText('Document-Content-Subjects-Uncontrolled-Subject0-Value', 'Eins');
        $this->assertElementContainsText('Document-Content-Subjects-Uncontrolled-Subject0-ExternalKey', 'Eins-Key');
        $this->assertElementContainsText('Document-Content-Subjects-Uncontrolled-Subject1-Language', 'English');
        $this->assertElementContainsText('Document-Content-Subjects-Uncontrolled-Subject1-Value', 'Eins');
        $this->assertElementContainsText('Document-Content-Subjects-Uncontrolled-Subject1-ExternalKey', '546');

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementValueEquals('Document-Content-Subjects-Uncontrolled-Subject0-Language', 'deu');
        $this->assertElementValueEquals('Document-Content-Subjects-Uncontrolled-Subject0-Value', 'Eins');
        $this->assertElementValueEquals('Document-Content-Subjects-Uncontrolled-Subject0-ExternalKey', 'Eins-Key');
        $this->assertElementValueEquals('Document-Content-Subjects-Uncontrolled-Subject1-Language', 'eng');
        $this->assertElementValueEquals('Document-Content-Subjects-Uncontrolled-Subject1-Value', 'Eins');
        $this->assertElementValueEquals('Document-Content-Subjects-Uncontrolled-Subject1-ExternalKey', '546');

        $this->clickAndWait('Document-Content-Subjects-Uncontrolled-Subject0-Remove');

        $this->assertElementValueEquals('Document-Content-Subjects-Uncontrolled-Subject0-Language', 'eng');
        $this->assertElementValueEquals('Document-Content-Subjects-Uncontrolled-Subject0-Value', 'Eins');
        $this->assertElementValueEquals('Document-Content-Subjects-Uncontrolled-Subject0-ExternalKey', '546');
        $this->assertElementNotPresent('Document-Content-Subjects-Uncontrolled-Subject1-Value');

        $this->clickAndWait('Document-Content-Subjects-Uncontrolled-Subject0-Remove');

        $this->assertElementNotPresent('Document-Content-Subjects-Uncontrolled-Subject0-Value');
        $this->assertElementNotPresent('Document-Content-Subjects-Uncontrolled-Subject1-Value');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementNotPresent('Document-Content-Subjects-Uncontrolled-Subject0-Value');
        $this->assertElementNotPresent('Document-Content-Subjects-Uncontrolled-Subject1-Value');
    }

    public function testRequiredErrorMessage() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');

        $this->assertElementNotPresent('Document-Content-Subjects-Swd-Subject0-Value');
        $this->assertElementNotPresent('Document-Content-Subjects-Psyndex-Subject0-Value');
        $this->assertElementNotPresent('Document-Content-Subjects-Uncontrolled-Subject0-Value');

        $this->clickAndWait('Document-Content-Subjects-Swd-Add');
        $this->clickAndWait('Document-Content-Subjects-Psyndex-Add');
        $this->clickAndWait('Document-Content-Subjects-Uncontrolled-Add');

        $this->assertElementPresent('Document-Content-Subjects-Swd-Subject0-Value');
        $this->assertElementPresent('Document-Content-Subjects-Psyndex-Subject0-Value');
        $this->assertElementPresent('Document-Content-Subjects-Uncontrolled-Subject0-Value');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//*[@id="actionboxContainer"]//*[@class="messages"]',
            'Document cannot be saved, because some input is not valid.');
        $this->assertElementContainsText(
            '//td[@id="Document-Content-Subjects-Swd-Subject0-Value-element"]/ul[@class="errors"]/li',
            'Value is required and can\'t be empty.');
        $this->assertElementContainsText(
            '//td[@id="Document-Content-Subjects-Psyndex-Subject0-Value-element"]/ul[@class="errors"]/li',
            'Value is required and can\'t be empty.');
        $this->assertElementContainsText(
            '//td[@id="Document-Content-Subjects-Uncontrolled-Subject0-Value-element"]/ul[@class="errors"]/li',
            'Value is required and can\'t be empty.');

    }

}