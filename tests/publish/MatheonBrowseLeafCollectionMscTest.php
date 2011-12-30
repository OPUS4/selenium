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
 * @copyright   Copyright (c) 2008-2011, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class MatheonBrowseLeafCollectionMscTest extends TestCase {

    public function testMscAndInstituteLeafCollectionBrowsingAndCheckPage() {
        $this->open("/opus4-selenium");
        $this->waitForPageToLoad("30000");
        $this->open("/opus4-selenium/home/index/language/language/de");
        $this->waitForPageToLoad("30000");
        $this->open("/opus4-selenium/publish");
        $this->click("//li[@id='primary-nav-publish']/a/em/span");
        $this->waitForPageToLoad("30000");
        $this->assertTrue($this->isElementPresent("link=English"));
        $this->select("documentType", "label=Preprint für MATHEON");
        $this->click("rights");
        $this->click("send");
        $this->waitForPageToLoad("30000");
        $this->type("PersonAuthorFirstName1", "Susi");
        $this->type("PersonAuthorLastName1", "Gottwald");
        $this->type("TitleMain1", "Entenhausen");
        $this->type("TitleAbstract1", "Testabstract");
        $this->click("send");
        $this->waitForPageToLoad("30000");
        $this->assertTrue($this->isElementPresent("//div[@id='content']/div[2]/div/div[@class='form-hint form-errors']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupInstitute']/div[2]/div/div[@class='form-errors']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupSubjectMSC']/div[2]/div/div[@class='form-errors']"));
        $this->select("Institute1", "label=Technische Universität Hamburg-Harburg");
        $this->click("browseDownInstitute");
        $this->waitForPageToLoad("30000");
        $this->select("collId2Institute1", "label=Bauwesen");
        $this->click("browseDownInstitute");
        $this->waitForPageToLoad("30000");
        $this->select("collId3Institute1", "label=Abwasserwirtschaft und Gewässerschutz B-2");
        $this->click("send");
        $this->waitForPageToLoad("30000");
        $this->assertTrue($this->isElementPresent("//div[@id='content']/div[2]/div/div[@class='form-hint form-errors']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupSubjectMSC']/div[2]/div/div[@class='form-errors']"));
        $this->select("SubjectMSC1", "label=00-XX GENERAL");
        $this->click("send");
        $this->waitForPageToLoad("30000");
        $this->assertTrue($this->isElementPresent("//div[@id='content']/div[2]/div/div[@class='form-hint form-errors']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupSubjectMSC']/div[2]/div/div[@class='form-errors']"));
        $this->click("browseDownSubjectMSC");
        $this->waitForPageToLoad("30000");
        $this->select("collId2SubjectMSC1", "label=00-02 Research exposition (monographs, survey articles)");
        $this->click("send");
        $this->waitForPageToLoad("30000");
        try {
            $this->assertTrue($this->isTextPresent("00-02"));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
        $this->assertTrue($this->isElementPresent("//div[@id='form-table-check']/fieldset"));
        $this->click("send");
        $this->waitForPageToLoad("30000");
        $this->assertTrue($this->isTextPresent("erfolgreich gespeichert"));
    }

}

?>
