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

    /**
     * Uses person 0.
     */
    public function testRemoveAuthor() {
        $this->switchToEnglish();
        $this->login();

        $this->open('/opus4-selenium/admin/document/edit/id/200/section/persons');
        $this->waitForPageToLoad();

        // Check correct page is shown
        $this->assertElementValueEquals('PersonEmai-0-email', 'doe@example.org');

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
        $this->assertElementNotPresent('PersonAuthor-0-email');
    }

    /**
     * Uses person 1.
     */
    public function testCancelRemoveAuthor() {
        $this->switchToEnglish();
        $this->login();

        $this->open('/opus4-selenium/admin/document/edit/id/200/section/persons');
        $this->waitForPageToLoad();

        // Check correct page is shown
        $this->assertElementValueEquals('PersonSubmitter-0-AcademicTitle', 'PhD');
        $this->assertTextPresent('Edit Persons');

        $this->click("PersonAuthor-0-remove");
        $this->waitForPageToLoad();

        // check confirmation page is shown
        $this->assertTextPresent("Remove 'Person' from document");
        $this->assertTextPresent('John');
        $this->assertTextPresent('Doe');
        $this->assertTextPresent('doe@example.org');
        $this->assertElementPresent('sureyes');
        $this->assertElementPresent('sureno');

        $this->click('sureno');
        $this->waitForPageToLoad();

        $this->assertTextPresent("'Person' was not removed (cancelled by user).");
        $this->assertTextPresent('Edit Persons');
        $this->assertElementValueEquals('PersonEmai-0-email', 'doe@example.org');
    }

}