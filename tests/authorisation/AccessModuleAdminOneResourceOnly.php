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
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2013, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'authorisation/TestCaseAuthorisation.php';

class AccessModuleAdminOneResourceOnly extends TestCaseAuthorisation {
    
    private $acls = array(
        'module_admin' => false,
        'indexmaintenance' => false,
        'job' => false
    );    
    
    public function setUp($username, $password, $acls) {
        parent::setUp();
        $this->setUsername($username);
        $this->setPassword($password);
        $this->acls = $acls;
    }
    
    private function assertElement($xpath, $present = true) {
        if ($present) {
            $this->assertElementPresent($xpath);
        }
        else {
            $this->assertElementNotPresent($xpath);
        }
    }
    
    private function assertNoAccess() {
        $this->assertElementContainsText('//html/head/title', 'Login');
        $this->assertElement('//html/body/div/div[3]/div[2]/h1', 'User Login');
        $this->assertElementContainsText('//html/body', 'Logout ' . $this->username);
    }    
                
    /**
     * Überprüft, ob nur die erlaubten Einträge im Admin Menu angezeigt werden.
     */
    public function testAdminMenuFiltering() {
        $this->loginAndOpenPage('/admin');
        $this->assertElement('//a[contains(@href, "/admin/licence")]', false);
        $this->assertElement('//a[contains(@href, "/admin/documents")]', false);
        $this->assertElement('//a[contains(@href, "/admin/security")]', false);
        $this->assertElement('//a[contains(@href, "/admin/collectionroles")]', false);
        $this->assertElement('//a[contains(@href, "/admin/series")]', false);
        $this->assertElement('//a[contains(@href, "/admin/language")]', false);
        $this->assertElement('//a[contains(@href, "/admin/dnbinstitute")]', false);        
        $this->assertElement('//a[contains(@href, "/admin/setup")]', true);
        $this->assertElement('//a[contains(@href, "/review")]', false);
        $this->assertElement('//a[contains(@href, "/admin/info")]', $this->acls['indexmaintenance'] || $this->acls['job']);
    }
        
    /**
     * Überprüft, ob auf die Seite zur Verwaltung von Lizenzen zugegriffen werden kann.
     */
    public function testAccessLicenceController() {
        $this->loginAndOpenPage('/admin/licence');
        $this->assertNoAccess();
    }
    
    /**
     * Überprüft, ob auf die Seite zur Verwaltung von Dokumenten zugegriffen werden kann.
     */
    public function testAccessDocumentsController() {
        $this->loginAndOpenPage('/admin/documents');
        $this->assertNoAccess();
    }

    /**
     * Überprüfe, dass keine Zugriff auf Module Review
     */
    public function testNoAccessReviewModule() {
        $this->loginAndOpenPage('/review');
        $this->assertNoAccess();
    }
            
    /**
     * Überprüft Zugriff auf die Einträge in der Rubrik "Setup" im Admin Untermenü
     */
    public function testAccessSetupMenu() {
        $this->loginAndOpenPage('/admin/setup');
        $this->assertElement('//a[contains(@href, "/admin/enrichmentkey")]', false);
        $this->assertElement('//a[contains(@href, "/setup/help-page")]', false);
        $this->assertElement('//a[contains(@href, "/setup/static-page")]', false);
        $this->assertElement('//a[contains(@href, "/setup/language")]', false);
    }    
        
    /**
     * Prüft, ob fuer Nutzer mit vollem Zugriff auf Admin Modul der Edit Link in der Frontdoor angezeigt wird.
     */
    public function testActionBoxInFrontdoorPresent() {
        $this->loginAndOpenPage('/frontdoor/index/index/docId/92');
        $this->assertElement('//div[@id="actionboxContainer"]', false);
    }
    
    public function testSubMenuInfo() {
        $this->loginAndOpenPage('/admin/info/menu');
        $this->assertElement('//a[contains(@href, "/admin/info")]', false);
        $this->assertElement('//a[contains(@href, "/admin/oailink")]', true);
        $this->assertElement('//a[contains(@href, "/admin/statistic")]', false);
        $this->assertElement('//a[contains(@href, "/admin/indexmaintenance")]', $this->acls['indexmaintenance']);
        $this->assertElement('//a[contains(@href, "/admin/job")]', $this->acls['job']);
    }
    
    public function testIndexmaintenance() {
        $this->loginAndOpenPage('/admin/indexmaintenance');
        if ($this->acls['indexmaintenance']) {
            $this->assertTextPresent('Solr Index Maintenance');
            $this->assertTextPresent('This feature is currently disabled.');
        }
        else {
            $this->assertNoAccess();
        }
    }
    
    public function testJob() {
        $this->loginAndOpenPage('/admin/job');
        if ($this->acls['job']) {
            $this->assertTextPresent('Job Processing');
            $this->assertTextPresent('Asynchronous Job Processing is disabled');            
        }
        else {
            $this->assertNoAccess();
        }        
    }

}
