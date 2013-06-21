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

class Opusvier2861Test extends TestCasePublish {

    public function testDepositWithMissingModelDnbInstitute() {
        $this->disableScreenshots();
        
        $this->switchToGerman();
        
        // open administration in another window        
        $this->openWindow('/admin', 'admin-window');
        $this->selectWindow('admin-window');                

        // create a new DNB institute for the purpose of this test only
        $this->login();
        $this->open('/admin/dnbinstitute/new');
        $this->type('Opus_DnbInstitute-Name-1', 'OPUSVIER-2861-DnbInstitute');
        $this->type('Opus_DnbInstitute-City-1', 'Berlin');
        $this->click('Opus_DnbInstitute-IsGrantor-1');
        $this->click('Opus_DnbInstitute-IsPublisher-1');
        $this->click('submit');
        $this->waitForPageToLoad();

        // select recently created DNB institute in publish form
        $this->selectWindow(null);
        
        $this->goToSecondStep('all');
        $this->select('ThesisGrantor_1', "label=OPUSVIER-2861-DnbInstitute");
        $this->select('ThesisPublisher_1', "label=OPUSVIER-2861-DnbInstitute");
        $this->click('LegalNotices');
        $this->goToThirdStep();
        $this->waitForPageToLoad();

        // delete recently created DNB institute
        $this->selectWindow('admin-window');

        $this->open('/admin/dnbinstitute');
        $this->click('//tbody/tr[5]//form/input[2]');
        $this->waitForPageToLoad();        
        
        $this->assertElementPresent('//div[@class="messages"]/div[@class="notice"]');

        // try to submit document in first window: selected DNB institute does not exist anymore
        $this->selectWindow(null);
        $this->click('send');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Anwendungsfehler');
        
        $this->assertTextNotPresent('Opus_Model_NotFoundException');
        $this->assertTextNotPresent('No Opus_Db_DnbInstitutes with id 5 in database.');        

        $this->enableScreenshots();                
    }

}

?>
