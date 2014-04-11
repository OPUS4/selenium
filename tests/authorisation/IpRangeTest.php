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
 * Tests Verhalten mit IP Ranges.
 * 
 * - nur IP Range
 * - IP Range und Nutzer
 */
class IpRangeTest extends TestCaseAuthorisation {
    
    /**
     * Schaltet ueber IP Range die Administration fuer den lokalen Rechner frei.
     */    
    public function testIpRangeLocalAdmin() {
        $this->switchToEnglish();
        $this->openAndWait('/home');
        $this->assertElementNotContainsText("//div[@id='header']", 'Administration');
        $this->createIpRange();
        $this->openAndWait('/home');
        $this->assertElementContainsText("//div[@id='header']", 'Administration');
        $this->removeIpRange();
        $this->openAndWait('/home');
        $this->assertElementNotContainsText("//div[@id='header']", 'Administration');
    }
    
    public function testIpRangeLocalLicenceAdmin() {
        $this->switchToEnglish();
        $this->createIpRange('licenceadmin');
        $this->openAndWait('/admin');
        $this->assertElementPresent('//a[contains(@href, "/admin/licence")]');
        $this->assertElementPresent('//a[contains(@href, "/admin/index/info")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/documents")]');
        $this->removeIpRange();
    }
    
    /**
     * Prueft, ob die Rechte der IP Range (Lizenzen) und des Users (Dokumente) greifen.
     */
    public function testIpRangeAndUser() {
        $this->switchToEnglish();
        $this->createIpRange('licenceadmin');
        $this->login('security8', 'security8pwd');
        $this->openAndWait('/admin');
        $this->assertElementPresent('//a[contains(@href, "/admin/licence")]');
        $this->assertElementPresent('//a[contains(@href, "/admin/index/info")]');
        $this->assertElementPresent('//a[contains(@href, "/admin/documents")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/language")]');
        $this->assertElementNotPresent('//a[contains(@href, "/admin/security")]');
        $this->removeIpRange();
    }    
    
}