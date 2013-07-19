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

class AccessModuleSetupAndAdmin extends TestCaseAuthorisation {
    
    private $acls = array(
        'module_admin' => false,
        'module_setup' => false,
        'controller_staticpage' => false,
        'controller_helppage' => false,
        'controller_language' => false
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
        $this->assertElement('//a[contains(@href, "/admin/licence")]', $this->acls['module_admin']);
        $this->assertElement('//a[contains(@href, "/admin/documents")]', $this->acls['module_admin']);
        $this->assertElement('//a[contains(@href, "/admin/security")]', $this->acls['module_admin']);
        $this->assertElement('//a[contains(@href, "/admin/collectionroles")]', $this->acls['module_admin']);
        $this->assertElement('//a[contains(@href, "/admin/series")]', $this->acls['module_admin']);
        $this->assertElement('//a[contains(@href, "/admin/language")]', $this->acls['module_admin']);
        $this->assertElement('//a[contains(@href, "/admin/dnbinstitute")]', $this->acls['module_admin']);
        $this->assertElement('//a[contains(@href, "/admin/info")]', $this->acls['module_admin']);
        $this->assertElement('//a[contains(@href, "/admin/setup")]', $this->acls['module_admin']);
        $this->assertElement('//a[contains(@href, "/review")]', false);
    }
        
    /**
     * Überprüft, ob auf die Seite zur Verwaltung von Lizenzen zugegriffen werden kann.
     */
    public function testAccessLicenceController() {
        $this->loginAndOpenPage('/admin/licence');
        if ($this->acls['module_admin']) {
            $this->assertElementContainsText('//html/head/title', 'Admin Licences');
        }
        else {
            $this->assertNoAccess();
        }
    }
    
    /**
     * Überprüft, ob auf die Seite zur Verwaltung von Dokumenten zugegriffen werden kann.
     */
    public function testAccessDocumentsController() {
        $this->loginAndOpenPage('/admin/documents');
        if ($this->acls['module_admin']) {
            $this->assertElementContainsText('//html/head/title', 'Administration of Documents');
        }
        else {
            $this->assertNoAccess();
        }        
    }

    /**
     * Überprüfe, dass keine Zugriff auf Module Review
     */
    public function testNoAccessReviewModule() {
        $this->loginAndOpenPage('/review');
        $this->assertNoAccess();
    }
        
    /**
     * Überprüft Zugriff auf Language Controller im Setup Modul
     */
    public function testAccessSetupModuleTranslations() {
        $this->loginAndOpenPage('/setup/language');
        if ($this->acls['module_setup'] || $this->acls['controller_language']) {
            $this->assertElementContainsText('//html/head//title', 'Translations');
        }
        else {
            $this->assertNoAccess();
        }        
    }

    /**
     * Überprüft Zugriff auf StaticPage Controller im Setup Modul
     */
    public function testAccessSetupModuleStaticPage() {
        $this->loginAndOpenPage('/setup/static-page');
        if ($this->acls['module_setup'] || $this->acls['controller_staticpage']) {
            $this->assertElementContainsText('//html/head//title', 'Static Pages');
        }
        else {
            $this->assertNoAccess();
        }
    }

    /**
     * Überprüft Zugriff auf HelpPage Controller im Setup Modul
     */
    public function testAccessSetupModuleHelpPage() {
        $this->loginAndOpenPage('/setup/help-page');
        if ($this->acls['module_setup'] || $this->acls['controller_helppage']) {
            $this->assertTextPresent('Please make sure that the web server has write access to the respective directory.');
            $this->assertElementContainsText('//html/body/div/div[3]/div[3]/a', 'Back');
        }
        else {
            $this->assertNoAccess();
        }
    }    
    
    /**
     * Überprüft Zugriff auf die Einträge in der Rubrik "Setup" im Admin Untermenü
     */
    public function testAccessSetupMenu() {
        $this->loginAndOpenPage('/admin/setup');
        $this->assertElement('//a[contains(@href, "/admin/enrichmentkey")]', $this->acls['module_admin']);
        $this->assertElement('//a[contains(@href, "/setup/help-page")]', $this->acls['module_admin'] && ($this->acls['module_setup'] || $this->acls['controller_helppage']));
        $this->assertElement('//a[contains(@href, "/setup/static-page")]', $this->acls['module_admin'] && ($this->acls['module_setup'] || $this->acls['controller_staticpage']));
        $this->assertElement('//a[contains(@href, "/setup/language")]', $this->acls['module_admin'] && ($this->acls['module_setup'] || $this->acls['controller_language']));
    }    
        
    /**
     * Prüft, ob fuer Nutzer mit vollem Zugriff auf Admin Modul der Edit Link in der Frontdoor angezeigt wird.
     */
    public function testActionBoxInFrontdoorPresent() {
        $this->loginAndOpenPage('/frontdoor/index/index/docId/92');
        $this->assertElement('//div[@id="actionboxContainer"]', $this->acls['module_admin']);
    }

}
