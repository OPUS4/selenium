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
class ReviewerAndPartialAdminTest extends TestCaseAuthorisation {
    
    /**
     * Prüft, ob 'Review' Eintrag im Hauptmenu existiert.
     */
    public function testMainMenu() {
        $this->switchToEnglish();
        $this->login("security5", "security5pwd");
        $this->openAndWait('/home');
        $this->assertElementContainsText("//div[@id='header']", 'Administration');
        $this->assertElementNotContainsText("//div[@id='header']", 'Review');
    }
    
    /**
     * Prüft, daß Review Link in Admin Menu erscheint.
     */
    public function testAdminMenuFiltering() {
        $this->switchToEnglish();
        $this->login("security5", "security5pwd");
        $this->openAndWait('/admin');
        $this->assertElementContainsText('//html/body', 'Review');
        $this->assertElementContainsText('//html/body', 'Licence types');
        $this->assertElementContainsText('//html/body', 'OAI Link Information');
    }
    
    /**
     * Prüft, ob auf die Startseite des Review Modules zugegriffen werden kann.
     */
    public function testAccessReviewModule() {
        $this->switchToEnglish();
        $this->login("security5", "security5pwd");
        $this->openAndWait('/review');
        $this->assertElementContainsText('//html/head/title', 'Review Documents');
    }

    /**
     * Prüft, ob auf den LicenceController zugegriffen werden kann.
     */
    public function testAccessLicenceController() {
        $this->switchToEnglish();
        $this->login("security5", "security5pwd");
        $this->openAndWait('/admin/licence');
        $this->assertElementContainsText('//html/head/title', 'Admin Licences');
    }

    /**
     * Prüft, ob auf den OaiLinkController zugriffen werden kann.
     */
    public function testAccessOaiLinkController() {
        $this->switchToEnglish();
        $this->login("security5", "security5pwd");
        $this->openAndWait('/admin/oailink');
        $this->assertElementContainsText('//html/head/title', 'OAI Link Information');
    }
    
    /**
     * Prüft, das nicht auf die Seite zur Verwaltung von Dokumenten zugegriffen werden kann.
     */
    public function testNoAccessDocumentsController() {
        $this->switchToEnglish();
        $this->login("security5", "security5pwd");
        $this->openAndWait('/admin/documents');
        $this->assertElementContainsText('//html/head/title', 'Login');
        $this->assertElementContainsText('//html/body', 'Logout security5');
    }

}
