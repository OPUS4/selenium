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
 * @author      Susanne Gottwald <gottwald@zib.de>
 * @copyright   Copyright (c) 2008-2011, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class Opusvier707Test extends TestCase {

    public function testDeutscheSprachversion() {
        $this->switchToGerman();
        $this->open("/opus4-selenium/publish");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isTextPresent("Veröffentlichen"));
        $this->select("documentType", "label=Ton");
        $this->click("rights");
        $this->click("send");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isTextPresent("Ton"));
        $this->type("PersonSubmitterFirstName_1", "foo");
        $this->type("PersonSubmitterLastName_1", "bar");
        $this->type("PersonSubmitterEmail_1", "test@mail.com");
        $this->type("TitleMain_1", "baz");
        $this->select("TitleMainLanguage_1", "label=Deutsch");
        $this->type("CompletedDate", "2010/09/28");
        $this->select("Language", "label=Deutsch");
        $this->select("Licence", "label=Creative Commons - Namensnennung");
        $this->click("send");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isTextPresent('Bitte ändern Sie 2010/09/28 in das Datumsformat TT.MM.JJJJ.'));
        $this->type("CompletedDate", "28.09.2010");
        $this->click("send");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isTextPresent("Bitte überprüfen Sie Ihre Eingaben."));
        $this->click("send");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isTextPresent("Dokument "));
        $this->assertTrue($this->isTextPresent(" wurde erfolgreich gespeichert."));
        $this->assertFalse($this->isTextPresent("Dokument betrachten."));
    }

    public function testEnglishLanguageVersion() {
        $this->switchToEnglish();
        $this->open("/opus4-selenium/publish");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isTextPresent("Publish"));
        $this->select("documentType", "label=Sound");
        $this->click("rights");
        $this->click("send");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isTextPresent("Sound"));
        $this->type("PersonSubmitterFirstName_1", "foo");
        $this->type("PersonSubmitterLastName_1", "bar");
        $this->type("PersonSubmitterEmail_1", "test@mail.com");
        $this->type("TitleMain_1", "baz");
        $this->select("TitleMainLanguage_1", "label=German");
        $this->type("CompletedDate", "28.09.2010");
        $this->select("Language", "label=German");
        $this->select("Licence", "label=Creative Commons - Namensnennung");
        $this->click("send");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isTextPresent("Please change 28.09.2010 to fit the date format YYYY/MM/DD."));
        $this->type("CompletedDate", "2010/09/28");
        $this->click("send");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isTextPresent("Please check your data."));
        $this->click("send");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isTextPresent("Document "));
        $this->assertTrue($this->isTextPresent(" was successfully published."));
        $this->assertFalse($this->isTextPresent("View document"));
    }

}
