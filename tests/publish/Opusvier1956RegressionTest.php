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
 * @package     Selenium_Tests
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2011, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class Opusvier1956RegressionTest extends TestCase {

    public function testMyTestCase() {
        $this->switchToEnglish();
        $this->open("/opus4-selenium/publish");
        $this->assertTrue($this->isElementPresent("documentType"));
        $this->select("documentType", "label=All fields (testing documenttype)");
        $this->click("rights");
        $this->click("send");
        $this->waitForPageToLoad();

        // PersonAuthor releated checks
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorFirstName_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorLastName_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorAcademicTitle_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorEmail_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorAllowEmailContact_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorDateOfBirth_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorPlaceOfBirth_1']"));
        $this->assertFalse($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']"));

        $this->click("addMorePersonAuthor");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorFirstName_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorLastName_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorAcademicTitle_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorEmail_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorAllowEmailContact_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorDateOfBirth_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorPlaceOfBirth_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorFirstName_2']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorLastName_2']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorAcademicTitle_2']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorEmail_2']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorAllowEmailContact_2']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorDateOfBirth_2']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorPlaceOfBirth_2']"));

        // TitleMain related checks
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']/div/input[@id='TitleMain_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']/div/select[@id='TitleMainLanguage_1']"));
        $this->assertFalse($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple even']"));

        $this->click("addMoreTitleMain");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']/div/input[@id='TitleMain_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']/div/select[@id='TitleMainLanguage_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple even']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple even']/div/input[@id='TitleMain_2']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple even']/div/select[@id='TitleMainLanguage_2']"));

        // TitleAbstract related checks
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']/div/textarea[@id='TitleAbstract_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']/div/select[@id='TitleAbstractLanguage_1']"));
        $this->assertFalse($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple even']"));

        $this->click("addMoreTitleAbstract");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']/div/textarea[@id='TitleAbstract_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']/div/select[@id='TitleAbstractLanguage_1']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple even']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple even']/div/textarea[@id='TitleAbstract_2']"));
        $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple even']/div/select[@id='TitleAbstractLanguage_2']"));
    }

}

?>
