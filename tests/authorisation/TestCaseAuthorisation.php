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
 * @author      Edouard Simon (edouard.simon@zib.de)
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

/**
 * Base class for authorisation tests
 */
class TestCaseAuthorisation extends TestCase {
    
    protected $username;
    
    protected $password;

    public function createUser($name, $password) {
        $this->login();
        $this->openAndWait('/admin/account/new');
        $this->type('id=username', $name);
        $this->type('id=password', $password);
        $this->type('id=confirmPassword', $password);
        $this->clickAndWait('id=submit');
        $this->logout();
    }

    public function removeUser($name) {
        $this->switchToEnglish();
        $this->login();
        $this->openAndWait('/admin/account');
        $this->clickAndWait('xpath=//table/tbody/tr/td/a[text()="'.$name.'"]/../../td/a[text()="Delete"]');
        $this->logout();
    }

    /**
     * invert access rights for roleId to given resources
     */
    public function toggleAccess($roleId, $resources) {
        $this->login();
        $this->open('/admin/access/listmodule/roleid/' . $roleId);
        $resources = is_array($resources) ? $resources : array($resources);
        foreach ($resources as $resource) {
            $this->click('set_' . $resource);
        }
        $this->clickAndWait('name=save_button');
        $this->clickAndWait('css=input.form-submit');
        $this->logout();
    }
    
    protected function createIpRange($role = 'fulladmin') {
        $this->login();
        $this->openAndWait('/admin/iprange/new');
        $this->type('id=name', 'clienthost');
        $this->type('id=startingip', $this->clientIp);
        $this->click("id=role$role");
        $this->clickAndWait('id=submit');
        $this->logout();
    }
    
    protected function removeIpRange() {
        $this->login();
        $this->openAndWait('/admin/iprange');
        $this->clickAndWait('//table/tbody/tr/td/div/a[text()="clienthost"]/../../../td/a[text()="Delete"]');
        $this->logout();
    }
    
    protected function loginAndOpenPage($page) {
        $this->switchToEnglish();
        $this->login($this->username, $this->password);
        $this->openAndWait($page);        
    }    
    
    protected function setUsername($username) {
        $this->username = $username;
    }
    
    protected function setPassword($password) {
        $this->password = $password;
    }
    
}
