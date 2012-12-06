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
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class Regression2540Test extends TestCase {

    public function testCreateCollectionRole() {
        $this->login();
        $this->switchToGerman();

        $this->open('/admin/collectionroles/new');
        $this->waitForPageToLoad();

        $this->type("id=Opus_Model_Filter-Name-1", "foobar");
        $this->type("id=Opus_Model_Filter-OaiName-1", "foobar");
        $this->select("id=Opus_Model_Filter-Position-1", "0");
        $this->click("submit");
        $this->waitForPageToLoad();

        $this->assertTextNotPresent("Collection role 'foobar' successfully created.");
        $this->assertTextPresent("Sammlung 'foobar' wurde erfolgreich angelegt.");
    }

    /**
     * @depends testCreateCollectionRole
     */
    public function testCreateCollection() {
        $this->login();
        $this->switchToGerman();

        $this->open('/admin/collectionroles');
        $this->waitForPageToLoad();

        $this->click("xpath=//table[@class='collections']/tbody/tr/td/a");
        $this->waitForPageToLoad();

        $this->click("xpath=//table[@class='collections']/tbody/tr/td/a");
        $this->waitForPageToLoad();

        $this->type("id=Opus_Model_Filter-Name-1", "collfoobar");
        $this->type("id=Opus_Model_Filter-Number-1", "12345");
        $this->type("id=Opus_Model_Filter-OaiSubset-1", "collfoobar");
        $this->click("submit");
        $this->waitForPageToLoad();

        $this->assertTextNotPresent('Insert successful');
        $this->assertTextPresent("Sammlungseintrag '12345 collfoobar' wurde erfolgreich angelegt.");
    }

    /**
     * @depends testCreateCollection
     */
    public function testEditCollectionRole() {
        $this->login();
        $this->switchToGerman();

        $this->open('/admin/collectionroles');
        $this->waitForPageToLoad();

        $this->click("xpath=//table[@class='collections']/tbody/tr/td[2]/a");
        $this->waitForPageToLoad();

        $this->click("submit");
        $this->waitForPageToLoad();

        $this->assertTextNotPresent("Collection role 'foobar' successfully edited.");
        $this->assertTextPresent("Sammlung 'foobar' wurde erfolgreich bearbeitet.");
    }

    /**
     * @depends testEditCollectionRole
     */   
    public function testEditCollection() {        
        $this->login();
        $this->switchToGerman();

        $this->open('/admin/collectionroles');
        $this->waitForPageToLoad();

        $this->click("xpath=//table[@class='collections']/tbody/tr/td/a");
        $this->waitForPageToLoad();

        $this->click("xpath=//table[@class='collections']/tbody/tr[2]/td[2]/a");
        $this->waitForPageToLoad();

        $this->click("submit");
        $this->waitForPageToLoad();

        $this->assertTextNotPresent("Edit successful");
        $this->assertTextPresent("Sammlungseintrag '12345 collfoobar' wurde erfolgreich bearbeitet.");
    }

    /**
     * @depends testEditCollection
     */   
    public function testDeleteCollection() {
        $this->login();
        $this->switchToGerman();

        $this->open('/admin/collectionroles');
        $this->waitForPageToLoad();

        $this->click("xpath=//table[@class='collections']/tbody/tr/td/a");
        $this->waitForPageToLoad();

        $this->chooseOkOnNextConfirmation();
        $this->click("//table[@class='collections']/tbody/tr[2]/td[7]/a");
        $this->assertConfirmationPresent("Sind Sie sicher?");
        $this->getConfirmation();
        $this->waitForPageToLoad();

        $this->assertTextNotPresent('Operation completed successfully.');
        $this->assertTextPresent("Sammlungseintrag '12345 collfoobar' wurde erfolgreich gelöscht.");
    }

    /**
     * @depends testDeleteCollection
     */
    public function testDeleteCollectionRole() {
        $this->login();
        $this->switchToGerman();

        $this->open('/admin/collectionroles');
        $this->waitForPageToLoad();

        $this->chooseOkOnNextConfirmation();
        $this->click("xpath=//table[@class='collections']/tbody/tr/td[7]/a");
        $this->assertConfirmationPresent("Sind Sie sicher?");
        $this->getConfirmation();
        $this->waitForPageToLoad();

        $this->assertTextNotPresent('Operation completed successfully.');
        $this->assertTextPresent("Sammlung 'foobar' wurde erfolgreich gelöscht.");
    }

}
