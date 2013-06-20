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
 * @category    Selenium Tests 
 * @package     Authorisation
 * @author      Jens Schwidder <schwidder@zib.de>
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'authorisation/TestCaseAuthorisation.php';

/**
 * 
 */
class SecurityAdminTest extends TestCaseAuthorisation {
    
    /**
     * Prüft, ob nur die erlaubten Einträge im Admin Menu angezeigt werden.
     */
    public function testAdminMenuFiltering() {
        $this->switchToEnglish();
        $this->login("security10", "security10pwd");
        $this->openAndWait('/admin');
        $this->assertElementPresent('//a[contains(@href, "/admin/security")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/collectionroles")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/documents")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/licence")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/series")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/language")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/dnbinstitute")]');
        $this->assertElementPresent('//a[contains(@href, "/admin/info")]'); // Untermenü für Informationen
        $this->assertElementNotPresent('//a[contains(@href, "/review")]');
    }
    
    public function testAccessAccountController() {
        $this->switchToEnglish();
        $this->login("security10", "security10pwd");
        $this->openAndWait('/admin/account');
        $this->assertElementContainsText('//html/head/title', 'Accounts');
        $this->assertElementContainsText('//html/body', 'Add Account');
    }
    
    public function testAccessIprangeController() {
        $this->switchToEnglish();
        $this->login("security10", "security10pwd");
        $this->openAndWait('/admin/iprange');
        $this->assertElementContainsText('//html/head/title', 'Manage IP Ranges');
        $this->assertElementContainsText('//html/body', 'Add IP range');
    }
    
    public function testAccessAccessController() {
        $this->switchToEnglish();
        $this->login("security10", "security10pwd");
        $this->openAndWait('/admin/access/listmodule/roleid/2');
        $this->assertElementContainsText('//html/head/title', 'Edit user roles - access control');
    }
    
}