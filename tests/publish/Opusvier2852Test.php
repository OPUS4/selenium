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
 * @package     Module_Publish
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2013, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCasePublish.php';

class Opusvier2852Test extends TestCasePublish {

    public function setUp() {
        parent::setUp();
        $this->disableScreenshots();
    }

    public function tearDown() {
        parent::tearDown();
        $this->enableScreenshots();
    }

    public function testDepositWithMissingEnrichmentKeyForDepositAction() {
        $testing = $this->isApplicationEnvTesting();
        $this->goToSecondStep('demo');
        $this->type('Enrichmentfoobarbaz_1', 'OPUSVIER2852Deposit');
        $this->goToThirdStep();
        $this->waitForPageToLoad();

        // open administration in another window
        $this->openWindow('/admin', 'admin-window');
        $this->selectWindow('admin-window');

        // delete enrichment key which is used in publish form
        $this->login();
        $this->open('/admin/enrichmentkey');
        $this->waitForPageToLoad();
        $this->assertTextPresent('foobarbaz');

        $this->open('/admin/enrichmentkey/delete/id/foobarbaz');
        $this->waitForPageToLoad();

        $this->clickAndWait('ConfirmYes');

        // try to submit document in first window: enrichment key does not exist anymore
        $this->selectWindow(null);
        $this->click('send');
        $this->waitForPageToLoad();

        $this->restoreEnrichmentKey();

        $this->assertTextPresent('Anwendungsfehler');
        $this->assertTextNotPresent('PDOException');
        $this->assertTextNotPresent('Integrity constraint violation');

        if (!$testing) {
            $this->assertTextPresent('Es ist ein unerwarteter Fehler aufgetreten. Ihre Eingaben sind gelöscht. Bitte versuchen Sie es erneut oder wenden Sie sich an den Administrator.');
        }
        else {
            $this->assertTextPresent('Application_Exception');
            $this->assertTextPresent('publish_error_unexpected');
        }
    }

    public function testDepositWithMissingEnrichmentKeyForCheckAction() {
        $testing = $this->isApplicationEnvTesting();

        $this->goToSecondStep('demo');
        $this->type('Enrichmentfoobarbaz_1', 'OPUSVIER2852Check');

        // open administration in another window
        $this->openWindow('/admin', 'admin-window');
        $this->selectWindow('admin-window');

        // delete enrichment key which is used in publish form
        $this->login();
        $this->open('/admin/enrichmentkey');
        $this->waitForPageToLoad();
        $this->assertTextPresent('foobarbaz');

        $this->open('/admin/enrichmentkey/delete/id/foobarbaz');
        $this->waitForPageToLoad();
        $this->clickAndWait('ConfirmYes');

        // try to submit document in first window: enrichment key does not exist anymore
        $this->selectWindow(null);
        $this->goToThirdStep();
        $this->waitForPageToLoad();

        $this->restoreEnrichmentKey();

        $this->assertTextPresent('Anwendungsfehler');
        $this->assertTextNotPresent('Publish_Model_FormIncorrectEnrichmentKeyException');
        if (!$testing) {
            $this->assertTextPresent('Das Enrichmentfeld foobarbaz wurde noch nicht in der Administration angelegt und darf nicht verwendet werden.');
        }
        else {
            $this->assertTextPresent('Application_Exception');
            $this->assertTextPresent('Das Enrichmentfeld foobarbaz wurde noch nicht in der Administration angelegt und darf nicht verwendet werden.');
        }
    }

    private function restoreEnrichmentKey() {
        $this->selectWindow('admin-window');

        $this->openAndWait('/admin/enrichmentkey/new');
        $this->type('Name', 'foobarbaz');
        $this->clickAndWait('Save');

        $this->selectWindow(null);
    }

}

?>
