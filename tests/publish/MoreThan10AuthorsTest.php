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
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class MoreThan10AuthorsTest extends TestCase {

    public function testDocumentWithMoreThan10Authors() {
        $this->switchToGerman();
        $this->open("/publish");
        $this->click("//li[@id='primary-nav-publish']/a/em/span");
        $this->waitForPageToLoad();

        $this->open("/auth/login");
        $this->type("login", "admin");
        $this->type("password", "adminadmin");
        $this->click("SubmitCredentials");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("link=English"));
        
        $this->click("//li[@id='primary-nav-publish']/a/span");
        $this->waitForPageToLoad();
        $this->select("id=documentType", "label=Arbeitspapier");
        $this->click("id=rights");
        $this->click("id=send");
        $this->waitForPageToLoad("30000");
        $this->type("id=PersonSubmitterLastName_1", "Doe");
        $this->type("id=TitleMain_1", "Entenhausen");
        $this->type("id=PersonAuthorLastName_1", "nachname 1");
        $this->click("id=addMorePersonAuthor");
        $this->waitForPageToLoad("30000");
        $this->type("id=PersonAuthorLastName_2", "nachname 2");
        $this->click("id=addMorePersonAuthor");
        $this->waitForPageToLoad("30000");
        $this->type("id=PersonAuthorLastName_3", "nachname 3");
        $this->click("id=addMorePersonAuthor");
        $this->waitForPageToLoad("30000");
        $this->type("id=PersonAuthorLastName_4", "nachname 4");
        $this->click("id=addMorePersonAuthor");
        $this->waitForPageToLoad("30000");
        $this->type("id=PersonAuthorLastName_5", "nachname 5");
        $this->click("id=addMorePersonAuthor");
        $this->waitForPageToLoad("30000");
        $this->type("id=PersonAuthorLastName_6", "nachname 6");
        $this->click("id=addMorePersonAuthor");
        $this->waitForPageToLoad("30000");
        $this->type("id=PersonAuthorLastName_7", "nachname 7");
        $this->click("id=addMorePersonAuthor");
        $this->waitForPageToLoad("30000");
        $this->type("id=PersonAuthorLastName_8", "nachname 8");
        $this->click("id=addMorePersonAuthor");
        $this->waitForPageToLoad("30000");
        $this->type("id=PersonAuthorLastName_9", "nachname 9");
        $this->click("id=addMorePersonAuthor");
        $this->waitForPageToLoad("30000");
        $this->type("id=PersonAuthorLastName_10", "nachname 10");
        $this->click("id=addMorePersonAuthor");
        $this->waitForPageToLoad("30000");
        $this->type("id=PersonAuthorLastName_11", "nachname 11");
        $this->select("id=Licence", "label=Veröffentlichungsvertrag für Publikationen mit Print on Demand");
        $this->click("id=send");
        $this->waitForPageToLoad("30000");
        $this->click("id=send");
        $this->waitForPageToLoad("30000");
        $this->click("link=Dokument betrachten.");
        $this->waitForPageToLoad("30000");

        $this->verifyTextPresent("exact:Verfasserangaben:");
        $this->verifyTextPresent("nachname 1");
        $this->verifyTextPresent("nachname 2");
        $this->verifyTextPresent("nachname 3");
        $this->verifyTextPresent("nachname 4");
        $this->verifyTextPresent("nachname 5");
        $this->verifyTextPresent("nachname 6");
        $this->verifyTextPresent("nachname 7");
        $this->verifyTextPresent("nachname 8");
        $this->verifyTextPresent("nachname 9");
        $this->verifyTextPresent("nachname 10");
        $this->verifyTextPresent("nachname 11");
        
        $this->click("link=Logout (admin)");
	$this->waitForPageToLoad("30000");
    }

}

?>
