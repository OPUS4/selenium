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

class IdentifierTest extends TestCase {

    public function testModifyIdentifiers() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');

        $this->assertElementNotPresent('Document-Identifiers-Identifier0-Value');

        $this->clickAndWait('Document-Identifiers-Add');

        $this->assertElementPresent('Document-Identifiers-Identifier0-Value');
        $this->assertElementNotPresent('Document-Identifiers-Identifier1-Value');

        $this->clickAndWait('Document-Identifiers-Add');

        $this->assertElementPresent('Document-Identifiers-Identifier0-Value');
        $this->assertElementPresent('Document-Identifiers-Identifier1-Value');

        $this->select('Document-Identifiers-Identifier0-Type', 'Handle');
        $this->type('Document-Identifiers-Identifier0-Value', 'MyID-Value');
        $this->select('Document-Identifiers-Identifier1-Type', 'Handle');
        $this->type('Document-Identifiers-Identifier1-Value', 'MyID-Value');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//*[@id="actionboxContainer"]//*[@class="messages"]',
            'Document cannot be saved, because some input is not valid.');
        $this->assertElementContainsText(
            '//td[@id="Document-Identifiers-Identifier1-Value-element"]/ul[@class="errors"]/li',
            'Identifier already exists for document.');

        $this->select('Document-Identifiers-Identifier1-Type', 'old Identifier');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementContainsText('Document-Identifiers-Identifier0-Type', 'Handle');
        $this->assertElementContainsText('Document-Identifiers-Identifier0-Value', 'MyID-Value');
        $this->assertElementContainsText('Document-Identifiers-Identifier1-Type', 'old Identifier');
        $this->assertElementContainsText('Document-Identifiers-Identifier1-Value', 'MyID-Value');

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementPresent('Document-Identifiers-Identifier0-Value');
        $this->assertElementPresent('Document-Identifiers-Identifier1-Value');

        $this->assertElementValueEquals('Document-Identifiers-Identifier0-Type', 'handle');
        $this->assertElementValueEquals('Document-Identifiers-Identifier0-Value', 'MyID-Value');
        $this->assertElementValueEquals('Document-Identifiers-Identifier1-Type', 'old');
        $this->assertElementValueEquals('Document-Identifiers-Identifier1-Value', 'MyID-Value');

        $this->type('Document-Identifiers-Identifier1-Value', 'Zwei');

        $this->clickAndWait('Document-Identifiers-Identifier0-Remove');

        $this->assertElementValueEquals('Document-Identifiers-Identifier0-Type', 'old');
        $this->assertElementValueEquals('Document-Identifiers-Identifier0-Value', 'Zwei');
        $this->assertElementNotPresent('Document-Identifiers-Identifier1-Value');

        $this->clickAndWait('Document-Identifiers-Identifier0-Remove');

        $this->assertElementNotPresent('Document-Identifiers-Identifier0-Value');
        $this->assertElementNotPresent('Document-Identifiers-Identifier1-Value');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementNotPresent('fieldset-Identifiers');
        $this->assertElementNotPresent('Document-Identifiers-Identifier0-Value');
        $this->assertElementNotPresent('Document-Identifiers-Identifier1-Value');
    }

}