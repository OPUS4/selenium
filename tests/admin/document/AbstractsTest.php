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
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class AbstractsTest extends TestCase {

    /**
     * Regression test for OPUSVIER-2353.
     */
    public function testRegression2353ExceptionForAbstractsEditForm() {
        $this->markTestIncomplete('Does not work. Using unit test instead.');
        $this->login();

        // check output
        $this->open('/opus4-selenium/admin/document/edit/id/92/section/abstracts');
        $this->waitForPageToLoad();
        $this->assertTextNotPresent('Application error');
        $this->assertTextNotPresent('Anwendungsfehler');
        $this->assertTextNotPresent('Fatal error');
        $this->assertTextNotPresent('Call to a member function setAttrib');

        $this->logout();
    }

    public function testTryAddingAbstractWithExistingLanguage() {
        $this->switchToEnglish();
        $this->login();

        $this->open('opus4-selenium/admin/document/add/id/146/section/abstracts');
        $this->waitForPageToLoad();
        $this->select('Opus_TitleAbstract-Language', 'value=deu');
        $this->type('Opus_TitleAbstract-Value', 'Deutscher Abstrakt');
        $this->click('Opus_TitleAbstract-submit_add');
        $this->waitForPageToLoad();

        $this->assertElementPresent('css=div.form-errors');
        $this->assertTextPresent('The form input is not valid.');
        $this->assertTextPresent('An entry with that language already exists.');

        $this->logout();
    }

    public function testAddingAndRemovingAbstract() {
        $this->switchToEnglish();
        $this->login();

        $this->open('opus4-selenium/admin/document/add/id/91/section/abstracts');
        $this->waitForPageToLoad();
        $this->select('Opus_TitleAbstract-Language', 'value=rus');
        $this->type('Opus_TitleAbstract-Value', 'Russian abstract');
        $this->click('Opus_TitleAbstract-submit_add');
        $this->waitForPageToLoad();

        $this->assertElementNotPresent('css=div.form-errors');
        $this->assertTextNotPresent('The form input is not valid.');
        $this->assertTextNotPresent('An entry with that language already exists.');
        $this->assertElementValueEquals('TitleAbstract-1-Language', 'rus');
        $this->assertElementValueEquals('TitleAbstract-1-Value', 'Russian abstract');
        $this->click('TitleAbstract-1-remove');
        $this->waitForPageToLoad();

        $this->assertElementNotPresent('css=div.form-errors');
        $this->assertElementNotPresent('TitleAbstract-1-Language');
        $this->assertElementNotPresent('TitleAbstract-1-Value');
        $this->assertElementNotPresent('TitleAbstract-1-remove');

        $this->logout();
    }

    public function testEditingAbstractsDuplicateLanguage() {
        $this->switchToEnglish();
        $this->login();

        $this->open('opus4-selenium/admin/document/edit/id/146/section/abstracts');
        $this->waitForPageToLoad();
        $this->select('TitleAbstract-1-Language', 'value=deu');
        $this->click('save');
        $this->waitForPageToLoad();

        $this->assertElementPresent('css=ul.errors');
        $this->assertTextPresent('The same language has been selected for more than one abstract.');

        $this->logout();
    }

    public function testEditingAbstracts() {
        $this->switchToEnglish();
        $this->login();

        $this->open('opus4-selenium/admin/document/edit/id/146/section/abstracts');
        $this->waitForPageToLoad();

        $this->select('TitleAbstract-0-Language', 'value=eng');
        $this->type('TitleAbstract-0-Value', 'Abstract 1');
        $this->select('TitleAbstract-1-Language', 'value=deu');
        $this->type('TitleAbstract-1-Value', 'Abstract 2');
        $this->click('save');
        $this->waitForPageToLoad();

        $this->assertElementNotPresent('css=ul.errors');
        $this->assertTextNotPresent('The same language has been selected for more than one abstract.');
        $this->assertElementValueEquals('TitleAbstract-0-Language', 'eng');
        $this->assertElementValueEquals('TitleAbstract-0-Value', 'Abtract 1');
        $this->assertElementValueEquals('TitleAbstract-1-Language', 'deu');
        $this->assertElementValueEquals('TitleAbstract-1-Value', 'Abstract 2');

        $this->select('TitleAbstract-0-Language', 'value=deu');
        $this->type('TitleAbstract-0-Value', 'Die KOBV-Zentrale in Berlin-Dahlem.');
        $this->select('TitleAbstract-1-Language', 'value=eng');
        $this->type('TitleAbstract-1-Value', 'Lorem impsum.');
        $this->click('save');
        $this->waitForPageToLoad();

        $this->logout();
    }

}