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

class Opusvier2850Test extends TestCasePublish {

    public function testUniqueURN() {
        $this->goToSecondStepForDoctypeAll();

        $this->assertElementPresent('IdentifierUrn');
        $this->type('IdentifierUrn', 'OPUSVIER2850-1');

        $this->click('send');
        $this->waitForPageToLoad();

        $this->assertTextNotPresent('Es sind Fehler aufgetreten');
        $this->assertTextPresent('Bitte überprüfen Sie Ihre Eingaben.');

        $this->click('abort');
    }

    public function testURNCollectionIsRecognizedInStep2() {
        $this->goToSecondStepForDoctypeAll();

        $this->assertElementPresent('IdentifierUrn');
        $this->type('IdentifierUrn', '123');

        $this->click('send');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Es sind Fehler aufgetreten');

        $this->type('IdentifierUrn', 'OPUSVIER2850-2');
                
        $this->click('send');
        $this->waitForPageToLoad();

        $this->assertTextNotPresent('Es sind Fehler aufgetreten');
        $this->assertTextPresent('Bitte überprüfen Sie Ihre Eingaben.');

        $this->click('abort');
    }

}

?>
