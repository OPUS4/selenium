<?PHP
/*
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
 * @category    Unit Test
 * @package     Module_Admin
 * @author      Jens Schwidder <schwidder@zib.de>
 * @copyright   Copyright (c) 2008-2011, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class PatentsTest extends TestCase {
    
    const SUCCESS_MESSAGE = 'Changes successfully saved.';

    public function testModifyGeneralMetadata() {
        $this->switchToEnglish();
        $this->login();
        
        $this->openAndWait('/admin/document/edit/id/250');
        
        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');
        
        $this->assertElementNotPresent('Document-Patents-Patent0-Id'); // keine Patente
        
        $this->click('Document-Patents-add');
        $this->waitForPageToLoad(30000);
        
        $this->assertElementPresent('Document-Patents-Patent0-Id');
        $this->assertElementNotPresent('Document-Patents-Patent1-Id'); // ein Patent Formular vorhanden
        
        $this->type('Document-Patents-Patent0-Number', '1234');
        $this->type('Document-Patents-Patent0-Application', 'Meine Erfindung');
        $this->type('Document-Patents-Patent0-YearApplied', '2001');
        $this->type('Document-Patents-Patent0-DateGranted', '2003/10/21');
        $this->type('Document-Patents-Patent0-Countries', 'Deutschland');

        $this->click('Document-save');
        $this->waitForPageToLoad(30000);
        $this->assertTextPresent(self::SUCCESS_MESSAGE);
        
        $this->assertElementContainsText('Document-Patents-Patent0-Number', '1234');
        $this->assertElementContainsText('Document-Patents-Patent0-Application', 'Meine Erfindung');
        $this->assertElementContainsText('Document-Patents-Patent0-YearApplied', '2001');
        $this->assertElementContainsText('Document-Patents-Patent0-DateGranted', '2003/10/21');
        $this->assertElementContainsText('Document-Patents-Patent0-Countries', 'Deutschland');

        $this->openAndWait('/admin/document/edit/id/250');
        
        $this->assertElementPresent('Document-Patents-Patent0-Number');
        
        $this->click('Document-Patents-Patent0-Remove');
        $this->waitForPageToLoad(30000);
        
        $this->assertElementNotPresent('Document-Patents-Patent0-Number');
        
        $this->click('Document-save');
        $this->waitForPageToLoad(30000);
        
        $this->assertTextPresent(self::SUCCESS_MESSAGE);
        $this->assertElementNotPresent('Document-Patents-Patent0-Number');
    }

}
