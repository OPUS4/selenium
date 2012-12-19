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

class Admin_AccessControllerTest extends TestCase {

    public function testRegression2281TranslationAdminAccessStore() {
        $this->switchToEnglish();
	$this->login();
        $this->open('/admin/access/listmodule/roleid/1');
        $this->waitForPageToLoad('30000');

        // Preparation
        $this->assertElementPresent('save_button');
        $this->click('save_button');
        $this->waitForPageToLoad();

        // Check
        $this->assertTextPresent('Operation complete');
        $this->assertElementNotContainsText('//html/head/title', 'admin_access_store');

	$this->logout();
    }
    
    public function testListModuleAction() {
        $this->switchToEnglish();
        $this->login();
        $this->openAndWait('/admin/access/listmodule/roleid/16');
        
        // check granted permissions
        $this->assertElementContainsText('//html/head/title', 'Edit user roles - access control');
        $this->assertElementContainsText('//*[@id="content"]/div[2]/h1', 'accesstest');
        $this->assertChecked('//input[@name="set_account"]');
        $this->assertChecked('//input[@name="set_admin"]');
        $this->assertChecked('//input[@name="set_resource_collections"]');
        $this->assertChecked('//input[@name="set_workflow_unpublished_published"]');
        
        // check permissions not granted
        $this->assertNotChecked('//input[@name="set_review"]');
        $this->assertNotChecked('//input[@name="set_resource_languages"]');
        $this->assertNotChecked('//input[@name="set_workflow_published_restricted"]');

        // select new permissions
        $this->click('//input[@name="set_review"]');
        $this->click('//input[@name="set_resource_languages"]');
        $this->click('//input[@name="set_workflow_published_restricted"]');
        
        // store
        $this->click('save_button');
        $this->waitForPageToLoad();

        // check success
        $this->assertElementContainsText('//html/body', 'Operation complete');
        
        $this->click('done_button');
        $this->waitForPageToLoad();
        
        $this->assertElementContainsText('//html/head/title', 'Role');
        $this->assertElementContainsText('//html/body', 'accesstest');
        
        $this->openAndWait('/admin/access/listmodule/roleid/16');
        
        $this->assertElementContainsText('//html/head/title', 'Edit user roles - access control');
        $this->assertElementContainsText('//*[@id="content"]/div[2]/h1', 'accesstest');
        $this->assertChecked('//input[@name="set_account"]');
        $this->assertChecked('//input[@name="set_admin"]');
        $this->assertChecked('//input[@name="set_resource_collections"]');
        $this->assertChecked('//input[@name="set_workflow_unpublished_published"]');
        $this->assertChecked('//input[@name="set_review"]');
        $this->assertChecked('//input[@name="set_resource_languages"]');
        $this->assertChecked('//input[@name="set_workflow_published_restricted"]');
        
        // remove permissions again
        
        // select new permissions
        $this->click('//input[@name="set_review"]');
        $this->click('//input[@name="set_resource_languages"]');
        $this->click('//input[@name="set_workflow_published_restricted"]');
        
        // store
        $this->click('save_button');
        $this->waitForPageToLoad();
        
        // check success
        $this->assertElementContainsText('//html/body', 'Operation complete');
        
        $this->openAndWait('/admin/access/listmodule/roleid/16');
        
        $this->assertElementContainsText('//html/head/title', 'Edit user roles - access control');
        $this->assertElementContainsText('//*[@id="content"]/div[2]/h1', 'accesstest');
        $this->assertChecked('//input[@name="set_account"]');
        $this->assertChecked('//input[@name="set_admin"]');
        $this->assertChecked('//input[@name="set_resource_collections"]');
        $this->assertChecked('//input[@name="set_workflow_unpublished_published"]');
        $this->assertNotChecked('//input[@name="set_review"]');
        $this->assertNotChecked('//input[@name="set_resource_languages"]');
        $this->assertNotChecked('//input[@name="set_workflow_published_restricted"]');
        
        $this->logout();
    }
    
    public function testListModulesCancel() {
        $this->switchToEnglish();
        $this->login();
        $this->openAndWait('/admin/access/listmodule/roleid/16');
        
        $this->assertElementContainsText('//html/head/title', 'Edit user roles - access control');
        $this->assertElementContainsText('//*[@id="content"]/div[2]/h1', 'accesstest');

        $this->click('cancel_button');
        $this->waitForPageToLoad();
        
        $this->assertElementContainsText('//html/head/title', 'Edit user roles - access control');
        $this->assertElementContainsText('//*[@id="content"]/div[2]/h2', 'Operation canceled');
        
        $this->click('done_button');
        $this->waitForPageToLoad();
        
        $this->assertElementContainsText('//html/head/title', 'Role');
        $this->assertElementContainsText('//html/body', 'accesstest');
        
        $this->logout();
    }
    
    public function testListRole() {
        $this->switchToEnglish();
        $this->login();
        $this->openAndWait('/admin/access/listrole/docid/300');
        
        $this->assertElementContainsText('//html/head/title', 'Access to Document');
        $this->assertElementContainsText('//html/body', '300');
        $this->assertNotChecked('//input[@name="accesstest"]');
        $this->assertNotChecked('//input[@name="reviewer"]');
        
        $this->click('accesstest');
        $this->click('reviewer');
        
        $this->click('save_button');
        $this->waitForPageToLoad();
        
        $this->assertElementContainsText('//html/body', 'Operation complete');
                
        $this->openAndWait('/admin/access/listrole/docid/300');
        
        $this->assertChecked('//input[@name="accesstest"]');
        $this->assertChecked('//input[@name="reviewer"]');
        
        $this->click('accesstest');
        $this->click('reviewer');
        
        $this->click('save_button');
        $this->waitForPageToLoad();
        
        $this->assertElementContainsText('//html/body', 'Operation complete');
        
        $this->click('done_button');
        $this->waitForPageToLoad();
        
        $this->assertElementContainsText('//html/head/title', 'Document');
        $this->assertElementContainsText('//html/body', 'Document (300)');
        
        
        $this->openAndWait('/admin/access/listrole/docid/300');
        
        $this->assertNotChecked('//input[@name="accesstest"]');
        $this->assertNotChecked('//input[@name="reviewer"]');
    }

    public function testListRoleCancel() {
        $this->switchToEnglish();
        $this->login();
        $this->openAndWait('/admin/access/listrole/docid/300');
        
        $this->assertElementContainsText('//html/head/title', 'Access to Document');
        $this->assertElementContainsText('//html/body', 'Available roles');

        $this->click('cancel_button');
        $this->waitForPageToLoad();
        
        $this->assertElementContainsText('//html/head/title', 'Edit user roles - access control');
        $this->assertElementContainsText('//*[@id="content"]/div[2]/h2', 'Operation canceled');
        
        $this->click('done_button');
        $this->waitForPageToLoad();
        
        $this->assertElementContainsText('//html/head/title', 'Document');
        $this->assertElementContainsText('//html/body', 'Document (300)');
        
        $this->logout();
    }
    
}
