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
 * @category    TODO
 * @package     TODO
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2013, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCasePublish.php';

class Opusvier2759Test extends TestCasePublish {

    public function testSelectOneCollectionNoLeaf() {
        $this->switchToGerman();
        $this->goToSecondStep('single_level_collection');

        $this->select('SLC_1', 'value=16207');
        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");

        $this->goBackToSecondStep();
        $this->assertSelectedValue('SLC_1', '16207');
        $this->click('browseDownSLC');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');
        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");

        $this->goBackToSecondStep();
        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');
        $this->assertSelectedValue('SLC_1', '16207');
        
        $this->click('browseUpSLC');
        $this->waitForPageToLoad();
        $this->assertTextNotPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->select('SLC_1', 'value=16208');
        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry B");

        $this->goBackToSecondStep();
        $this->assertSelectedValue('SLC_1', '16208');
        $this->click('browseDownSLC');        
        $this->waitForPageToLoad();
        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry B");

        $this->goBackToSecondStep();
        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');
        $this->assertSelectedValue('SLC_1', '16208');
        $this->click('browseUpSLC');
        $this->waitForPageToLoad();
        $this->assertTextNotPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry B");
        $this->click('abort');
    }

    public function testSelectOneCollectionLeaf() {
        $this->switchToGerman();
        $this->goToSecondStep('single_level_collection');
        $this->select('SLC_1', 'value=16207');
        $this->click('browseDownSLC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");

        $this->goBackToSecondStep();
        $this->assertSelectedValue('SLC_1', '16207');
        $this->click('browseUpSLC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");
        $this->click('abort');
    }

    public function testSelectTwoCollectionsNoLeaf() {
        $this->switchToGerman();
        $this->goToSecondStep('single_level_collection');

        $this->select('SLC_1', 'value=16207');
        $this->click('addMoreSLC');
        $this->waitForPageToLoad();

        $this->select('SLC_2', 'value=16208');
        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");
        $this->assertTextPresent("s-l coll entry B");

        $this->goBackToSecondStep();
        $this->assertSelectedValue('SLC_1', '16207');
        $this->assertSelectedValue('SLC_2', '16208');

        $this->click('deleteMoreSLC');
        $this->waitForPageToLoad();
        $this->assertSelectedValue('SLC_1', '16207');

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");
        $this->assertTextNotPresent("s-l coll entry B");

        $this->goBackToSecondStep();
        $this->assertSelectedValue('SLC_1', '16207');

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");
        $this->assertTextNotPresent("s-l coll entry B");

        $this->goBackToSecondStep();
        $this->assertSelectedValue('SLC_1', '16207');

        $this->click('addMoreSLC');
        $this->waitForPageToLoad();

        $this->select('SLC_2', 'value=16208');
        $this->click('addMoreSLC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");
        $this->assertTextPresent("s-l coll entry B");

        $this->goBackToSecondStep();
        $this->assertSelectedValue('SLC_1', '16207');
        $this->assertSelectedValue('SLC_2', '16208');

        $this->click('deleteMoreSLC');
        $this->waitForPageToLoad();
        $this->assertSelectedValue('SLC_1', '16207');
        $this->assertSelectedValue('SLC_2', '16208');

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");
        $this->assertTextPresent("s-l coll entry B");

        $this->click('abort');
    }

    public function testSelectTwoCollectionsLeaf() {
        $this->switchToGerman();
        $this->goToSecondStep('single_level_collection');

        $this->select('SLC_1', 'value=16207');
        $this->click('browseDownSLC');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->click('addMoreSLC');
        $this->waitForPageToLoad();

        $this->select('SLC_2', 'value=16208');
        $this->click('browseDownSLC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");
        $this->assertTextPresent("s-l coll entry B");

        $this->goBackToSecondStep();
        $this->assertSelectedValue('SLC_1', '16207');
        $this->assertSelectedValue('SLC_2', '16208');

        $this->click('deleteMoreSLC');
        $this->waitForPageToLoad();
        $this->assertSelectedValue('SLC_1', '16207');
        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");
        $this->assertTextNotPresent("s-l coll entry B");

        $this->goBackToSecondStep();
        $this->assertSelectedValue('SLC_1', '16207');
        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");
        $this->assertTextNotPresent("s-l coll entry B");

        $this->goBackToSecondStep();
        $this->assertSelectedValue('SLC_1', '16207');
        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->click('addMoreSLC');
        $this->waitForPageToLoad();

        $this->select('SLC_2', 'value=16208');
        $this->click('browseDownSLC');
        $this->waitForPageToLoad();

        $this->click('addMoreSLC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");
        $this->assertTextPresent("s-l coll entry B");

        $this->goBackToSecondStep();
        $this->assertSelectedValue('SLC_1', '16207');
        $this->assertSelectedValue('SLC_2', '16208');

        $this->click('deleteMoreSLC');
        $this->waitForPageToLoad();
        $this->assertSelectedValue('SLC_1', '16207');
        $this->assertSelectedValue('SLC_2', '16208');

        $this->goToThirdStep();
        $this->assertTextPresent("s-l coll entry A");
        $this->assertTextPresent("s-l coll entry B");

        $this->click('abort');
    }

}

?>
