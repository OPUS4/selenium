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

/**
 * TODO in Unit Tests umwandeln (post = {}, dispatch())
 */

require_once 'TestCase.php';

class Regression2543Test extends TestCase {
    
    const COL_ROLE_NAME = 'foobar2';
    
    const COL_NAME = 'collfoobar2';

    public function testCreateCollectionRole() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles/new');
        
        $this->type("Name", self::COL_ROLE_NAME);
        $this->type("OaiName", self::COL_ROLE_NAME);
        $this->select("Position", "value=1");
        $this->clickAndWait("Save");

        $this->assertTextPresent("Sammlung '" . self::COL_ROLE_NAME . "' wurde erfolgreich angelegt.");
    }

    /**
     * @depends testCreateCollectionRole
     */
    public function testCreateCollection() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles');

        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr/th/a");
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr/td/a");

        $this->type("Name", self::COL_NAME);
        $this->type("Number", "12345");
        $this->type("OaiSubset", self::COL_NAME);
        $this->clickAndWait("Save");

        $this->assertTextPresent("Sammlungseintrag '12345 " . self::COL_NAME ."' wurde erfolgreich angelegt.");
    }

    /**
     * Legt zweite Collection in erste Ebene an (Position 1).
     * 
     * @depends testCreateCollection
     */
    public function testCreateAnotherCollection() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles');
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr/th/a");
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr/td/a");

        $this->type("Name", "collbaz");
        $this->type("Number", "56789");
        $this->type("OaiSubset", "collbaz");
        $this->clickAndWait("Save");

        $this->assertTextPresent("Sammlungseintrag '56789 collbaz' wurde erfolgreich angelegt.");
    }

    /**
     * @depends testCreateAnotherCollection
     */
    public function testMakeCollectionInvisible() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles');
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr/th/a");
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr[2]/td[contains(@class, 'hide')]/a");

        $this->assertTextNotPresent("Operation completed successfully.");
        $this->assertTextPresent("Sichtbarkeit des Sammlungseintrags '56789 collbaz' wurde erfolgreich geändert.");
    }

    /**
     * @depends testMakeCollectionInvisible
     */
    public function testMakeCollectionVisible() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles');
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr/th/a");
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr[2]/td[2]/a");

        $this->assertTextNotPresent("Operation completed successfully.");
        $this->assertTextPresent("Sichtbarkeit des Sammlungseintrags '56789 collbaz' wurde erfolgreich geändert.");
    }

    /**
     * @depends testMakeCollectionVisible
     */
    public function testMakeCollectionRoleInvisible() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles');
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr/td[contains(@class,'hide')]/a");

        $this->assertTextNotPresent("Operation completed successfully.");
        $this->assertTextPresent("Sichtbarkeit der Sammlung '". self::COL_ROLE_NAME . "' wurde erfolgreich geändert.");
    }

    /**
     * @depends testMakeCollectionRoleInvisible
     */
    public function testMakeCollectionRoleVisible() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles');
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr/td[2]/a");

        $this->assertTextNotPresent("Operation completed successfully.");
        $this->assertTextPresent("Sichtbarkeit der Sammlung '". self::COL_ROLE_NAME . "' wurde erfolgreich geändert.");
    }

    /**
     * @depends testMakeCollectionRoleVisible
     */
    public function testMoveUpCollection() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles');
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr/th/a");
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr[4]/td[@class='move-up']/a");

        $this->assertTextNotPresent("Operation completed successfully.");
        $this->assertTextPresent("Sammlungseintrag '12345 " . self::COL_NAME ."' wurde erfolgreich verschoben.");
    }

    /**
     * @depends testMoveUpCollection
     */
    public function testDownUpCollection() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles');
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr/th/a");
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr[2]/td[@class='move-down']/a");

        $this->assertTextNotPresent("Operation completed successfully.");
        $this->assertTextPresent("Sammlungseintrag '12345 " . self::COL_NAME ."' wurde erfolgreich verschoben.");
    }   

    /**
     * @depends testMoveDownCollection
     */
    public function testMoveUpCollectionRole() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles');
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr/td[4]/a");

        $this->assertTextNotPresent("Operation completed successfully.");
        $this->assertTextPresent("Sammlung '" . self::COL_ROLE_NAME . "' wurde erfolgreich verschoben.");
    }

    /**
     * @depends testMoveUpCollectionRole
     */
    public function testMoveDownCollectionRole() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles');
        $this->clickAndWait("xpath=//table[@class='collections']/tbody/tr[2]/td[3]/a");

        $this->assertTextNotPresent("Operation completed successfully.");
        $this->assertTextPresent("Sammlung '" . self::COL_ROLE_NAME . "' wurde erfolgreich verschoben.");
    }

    /**
     * @depends testMoveDownCollectionRole
     */
    public function testDeleteCollectionRole() {
        $this->login();
        $this->switchToGerman();

        $this->openAndWait('/admin/collectionroles');

        $this->chooseOkOnNextConfirmation();
        $this->click("xpath=//table[@class='collections']/tbody/tr/td[6]/a");
        $this->assertConfirmationPresent("Das zu löschende Element hat Unterelemente. Der Löschvorgang führt dazu, dass auch diese Elemente gelöscht werden. Wollen Sie den Löschvorgang wirklich durchführen?");
        $this->getConfirmation();
        $this->waitForPageToLoad();

        $this->assertTextPresent("Sammlung '" . self::COL_ROLE_NAME . "' wurde erfolgreich gelöscht.");
    }

}
