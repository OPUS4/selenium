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
 * @package     Selenium Test
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2013, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class Opusvier2820Test extends TestCase {

    public function testPatentInformationGerman() {
        $this->switchToGerman();

        $this->open("/frontdoor/index/index/docId/146");
        $this->waitForPageToLoad();

        $this->assertTextPresent('Patentnummer:');
        $this->assertTextPresent('1234');
        $this->assertTextPresent('Land der Patentanmeldung:');
        $this->assertTextPresent('DDR');
        $this->assertTextPresent('Jahr der Patentanmeldung:');
        $this->assertTextPresent('1970');
        $this->assertTextPresent('Patentanmeldung:');
        $this->assertTextPresent('The foo machine.');
        $this->assertTextPresent('Datum der Patenterteilung:');
        $this->assertTextPresent('01.01.1970');
    }

    public function testPatentInformationEnglish() {
        $this->switchToEnglish();

        $this->open("/frontdoor/index/index/docId/146");
        $this->waitForPageToLoad();

        $this->assertTextPresent('Patent Number:');
        $this->assertTextPresent('1234');
        $this->assertTextPresent('Country of Patent Application:');
        $this->assertTextPresent('DDR');
        $this->assertTextPresent('Patent Application Year:');
        $this->assertTextPresent('1970');
        $this->assertTextPresent('Patent Application:');
        $this->assertTextPresent('The foo machine.');
        $this->assertTextPresent('Patent Grant Date:');
        $this->assertTextPresent('1970/01/01');
    }

    public function testPatentInformationMultiple() {
        $this->markTestSkipped("Document 200 ist für Löschtests, daher fehlt das zweite Patent unter Umständen.");
        $this->switchToEnglish();

        $this->open("/frontdoor/index/index/docId/200");
        $this->waitForPageToLoad();

        $this->assertTextPresent('Patent Number:');
        $this->assertTextPresent('1234');
        $this->assertTextPresent('4321');
        $this->assertTextPresent('Country of Patent Application:');
        $this->assertTextPresent('DDR');
        $this->assertTextPresent('BRD');
        $this->assertTextPresent('Patent Application Year:');
        $this->assertTextPresent('1970');
        $this->assertTextPresent('1972');
        $this->assertTextPresent('Patent Application:');
        $this->assertTextPresent('The foo machine.');
        $this->assertTextPresent('The bar machine.');
        $this->assertTextPresent('Patent Grant Date:');
        $this->assertTextPresent('1970/01/01');
        $this->assertTextPresent('1972/01/01');
    }

}
