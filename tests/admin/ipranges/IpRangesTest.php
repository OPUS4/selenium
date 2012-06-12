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
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class IpRangesTest extends TestCase {

    /**
     * Regression test for OPUSVIER-2440.
     */
    public function testNonAlnumDescription() {
        $this->login();
        $this->switchToEnglish();

        // check output
        $this->open('/opus4-selenium/admin/iprange/new');
        $this->waitForPageToLoad();

        $description = 'My IP Range (1)'; // contains spaces and brackets
        $iprange = '127.0.0.1';

        $this->type('name', $description);
        $this->type('startingip', $iprange);

        $this->click('submit');
        $this->waitForPageToLoad();

        // Test for negative result
        $this->assertElementNotPresent('css=ul.errors');
        $this->assertTextNotPresent('contains characters which are non alphabetic and no digits');

        // Test for positive result
        $this->assertElementContainsText('//html/head/title', 'Manage IP Ranges');

        $this->logout();
    }

    /**
     * Regression test for OPUSVIER-2441.
     */
    public function testNoHostnameInput() {
        $this->login();
        $this->switchToEnglish();

        $this->open('/opus4-selenium/admin/iprange/new');
        $this->waitForPageToLoad();

        $description = 'My IP Range'; // contains spaces and brackets
        $iprange = 'www.foobar.com';

        $this->type('name', $description);
        $this->type('startingip', $iprange);

        $this->click('submit');
        $this->waitForPageToLoad();

        // Test for negative result
        $this->assertElementNotPresent('css=div.exceptionMessage');
        $this->assertTextNotPresent('Startingip	\'www.foobar.com\' appears');

        // Test for positive result
        $this->assertElementNotPresent('css=ul.errors');
        $this->assertTextNotPresent('\'www.foobar.com\' appears to');

        $this->logout();
    }

    /**
     *
     */
    public function testAddingSingleIpRange() {
        $this->login();
        $this->switchToEnglish();

        // check output
        $this->open('/opus4-selenium/admin/iprange/new');
        $this->waitForPageToLoad();

        $description = 'My IP Range (3)'; // contains spaces and brackets
        $iprange = '127.0.0.3';

        $this->type('name', $description);
        $this->type('startingip', $iprange);

        $this->click('submit');
        $this->waitForPageToLoad();

        // Test for positive result
        $this->assertElementContainsText('//html/head/title', 'Manage IP Ranges');
        $this->assertTextPresent('My IP Range (3)');
        $this->assertTextPresent('127.0.0.3 - 127.0.0.3');

        $this->logout();
    }

}