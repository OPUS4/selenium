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
class LicencesAdminTest extends TestCaseAuthorisation {
    
    /**
     * Prüft, ob nur die erlaubten Einträge im Admin Menu angezeigt werden.
     */
    public function testAdminMenuFiltering() {
        $this->switchToEnglish();
        $this->login("security2", "security2pwd");
        $this->openAndWait('/admin');
        $this->assertTextPresent('Licence types');
        $this->assertTextPresent('OAI Link Information');
        $this->assertTextNotPresent('Manage Documents');
        $this->assertTextNotPresent('Review');
        $this->assertTextNotPresent('Accounts');
        $this->assertTextNotPresent('Access Control');
        $this->assertTextNotPresent('Manage Collections');
        $this->assertTextNotPresent('Manage Series');
        $this->assertTextNotPresent('Languages');
        $this->assertTextNotPresent('Publication statistics');
        $this->assertTextNotPresent('Institution (dispersive body)');
        $this->assertTextNotPresent('Manage Enrichmentkeys');
        $this->assertTextNotPresent('System Information');
    }
    
    /**
     * Prüft, ob auf die Seite zur Verwaltung von Lizenzen zugegriffen werden kann.
     */
    public function testAccessLicenceController() {
        $this->switchToEnglish();
        $this->login("security2", "security2pwd");
        $this->openAndWait('/admin/licence');
        $this->assertElementContainsText('//html/head/title', 'Admin Licences');
    }
    
    /**
     * Prüft, das nicht auf die Seite zur Verwaltung von Dokumenten zugegriffen werden kann.
     */
    public function testNoAccessDocumentsController() {
        $this->switchToEnglish();
        $this->login("security2", "security2pwd");
        $this->openAndWait('/admin/documents');
        $this->assertElementContainsText('//html/head/title', 'Login');
        $this->assertElementContainsText('//html/body', 'Logout security2');
    }
    
        /**
     * Prüft, ob fuer Nutzer mit vollem Zugriff auf Admin Modul der Edit Link in der Frontdoor angezeigt wird.
     */
    public function testEditLinkInFrontdoorNotPresent() {
        $this->switchToEnglish();
        $this->login("security2", "security2pwd");
        $this->openAndWait('/frontdoor/index/index/docId/92');
        $this->assertElementNotContainsText('//html/body', 'Edit this document');
    }


}
