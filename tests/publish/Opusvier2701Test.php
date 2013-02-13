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

class Opusvier2701Test extends TestCasePublish {


    public function testDisplayVisualGrouping() {
        $this->goToSecondStepForDoctypeAll();

        $this->assertElementPresent('//div[contains(@class, "odd")]/div/select[@id="SubjectMSC_1"]');
        
        $this->select('SubjectMSC_1', 'value=7653');

        
        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->select('collId2SubjectMSC_1', 'value=7655');

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();
        
        $this->assertElementPresent('//div[contains(@class, "even")]/div/select[@id="SubjectMSC_2"]');
        
        $this->select('SubjectMSC_2', 'value=7871');

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->select('collId2SubjectMSC_2', 'value=7878');

        
        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->select('collId3SubjectMSC_2', 'value=7881');
        
        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertElementPresent('//div[contains(@class, "odd")]/div/select[@id="SubjectMSC_3"]');
        
        $this->select('SubjectMSC_3', 'value=9152');

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->select('collId2SubjectMSC_3', 'value=9208');

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->select('collId3SubjectMSC_3', 'value=9209');

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        
        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();

        
        $this->assertElementPresent('//div[contains(@class, "odd")]/div/select[@id="SubjectMSC_1"]');
        $this->assertElementPresent('//div[contains(@class, "even")]/div/select[@id="SubjectMSC_2"]');
        $this->assertElementPresent('//div[contains(@class, "odd")]/div/select[@id="SubjectMSC_3"]');
        $this->assertElementPresent('//div[contains(@class, "even")]/div/select[@id="SubjectMSC_4"]');

        $this->click('deleteMoreSubjectMSC');
        $this->waitForPageToLoad();
        
        $this->assertElementPresent('//div[contains(@class, "odd")]/div/select[@id="SubjectMSC_1"]');
        $this->assertElementPresent('//div[contains(@class, "even")]/div/select[@id="SubjectMSC_2"]');
        $this->assertElementPresent('//div[contains(@class, "odd")]/div/select[@id="SubjectMSC_3"]');
        $this->assertElementNotPresent('//div[contains(@class, "even")]/div/select[@id="SubjectMSC_4"]');
        
        $this->click('abort');
    }


}

?>
