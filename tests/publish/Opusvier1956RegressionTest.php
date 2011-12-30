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

class Opusvier1956RegressionTest extends TestCase
{
  public function testMyTestCase()
  {
    $this->open("/opus4-selenium");
    $this->waitForPageToLoad("30000");
    $this->open("/opus4-selenium/home/index/language/language/en");
    $this->waitForPageToLoad("30000");
    $this->open("/opus4-selenium/publish");
    $this->assertTrue($this->isElementPresent("documentType"));
    $this->select("documentType", "label=All fields (testing documenttype)");
    $this->click("rights");
    $this->click("send");
    $this->waitForPageToLoad("30000");

    // PersonAuthor releated checks
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorFirstName1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorLastName1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorAcademicTitle1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorEmail1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorAllowEmailContact1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorDateOfBirth1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorPlaceOfBirth1']"));
    $this->assertFalse($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']"));

    $this->click("addMorePersonAuthor");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorFirstName1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorLastName1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorAcademicTitle1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorEmail1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorAllowEmailContact1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorDateOfBirth1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple odd']/div/input[@id='PersonAuthorPlaceOfBirth1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorFirstName2']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorLastName2']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorAcademicTitle2']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorEmail2']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorAllowEmailContact2']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorDateOfBirth2']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupPersonAuthor']/div[@class='form-multiple even']/div/input[@id='PersonAuthorPlaceOfBirth2']"));

    // TitleMain related checks
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']/div/input[@id='TitleMain1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']/div/input[@id='TitleMainLanguage1']"));
    $this->assertFalse($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple even']"));

    $this->click("addMoreTitleMain");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']/div/input[@id='TitleMain1]"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple odd']/div/input[@id='TitleMainLanguage1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple even']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple even']/div/input[@id='TitleMain2']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleMain']/div[@class='form-multiple even']/div/input[@id='TitleMainLanguage2']"));

    // TitleAbstract related checks
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']/div/input[@id='TitleAbstract1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']/div/input[@id='TitleAbstractLanguage1']"));
    $this->assertFalse($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple even']"));

    $this->click("addMoreTitleAbstract");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']/div/input[@id='TitleAbstract1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple odd']/div/input[@id='TitleAbstractLanguage1']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple even']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple even']/div/input[@id='TitleAbstract2']"));
    $this->assertTrue($this->isElementPresent("//fieldset[@id='groupTitleAbstract']/div[@class='form-multiple even']/div/input[@id='TitleAbstractLanguage2']"));

  }
}
?>
