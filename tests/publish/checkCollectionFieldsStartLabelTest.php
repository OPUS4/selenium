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
 * @category    Application
 * @package     Module_Publish
 * @package     Module_Publish Selenium Test MATHEON
 * @author      Susanne Gottwald <gottwald@zib.de>
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class checkCollectionFieldsStartLabelTest extends TestCase {

    public function testCollectionSelectionLabel() {
        $this->open("/opus4-selenium");
        $this->waitForPageToLoad("30000");
        $this->open("/opus4-selenium/home/index/language/language/de");
        $this->waitForPageToLoad("30000");
        $this->open("/opus4-selenium/publish");
        $this->click("//li[@id='primary-nav-publish']/a/em/span");
        $this->waitForPageToLoad("30000");

        $this->select("id=documentType", "label=collections");
        $this->click("id=rights");
        $this->click("id=send");
        $this->waitForPageToLoad("30000");
        $this->verifyTextPresent("Bitte wählen Sie eine MSC Klasse");
        $this->verifyTextPresent("Bitte wählen Sie eine DDC Klasse");
        $this->verifyTextPresent("Bitte wählen Sie eine PACS Klasse");
        $this->verifyTextPresent("Bitte wählen Sie eine CCS Klasse");
        $this->verifyTextPresent("Bitte wählen Sie ein Institut");
        try {
            $this->assertFalse($this->isTextPresent("choose_valid_institutes"));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
        try {
            $this->assertFalse($this->isTextPresent("choose_valid_ddc"));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
        try {
            $this->assertFalse($this->isTextPresent("choose_valid_ccs"));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
        try {
            $this->assertFalse($this->isTextPresent("choose_valid_pacs"));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
        try {
            $this->assertFalse($this->isTextPresent("choose_valid_msc"));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
    }

}

?>