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
 * @author      Jens Schwidder <schwidder@zib.de>
 * @copyright   Copyright (c) 2008-2013, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

/**
 * Tests für das Verhalten beim Löschen von Dateien.
 * 
 * Zusätzlich zu den Selenium Tests gibt es auch noch Unit Tests für den FilemanagerController. 
 */
class DeleteFileTest extends TestCase {

    public function setUp() {
        parent::setUp();
    }

    /**
     * Dateien entfernen und dann abbrechen.
     */
    public function testDeleteFileCancel() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/index/id/124');

        $this->assertElementPresent('FileLink-125');

        $this->openAndWait('/admin/filemanager/index/id/124');

        $this->assertElementContainsText('//div[@class="breadcrumbsContainer"]', 'Files');
        $this->assertElementContainsText('//div[@id="docinfo"]', '124');

        $this->clickAndWait('FileManager-Action-Cancel');

        $this->assertElementPresent('FileLink-125');
        $this->assertElementNotPresent('FileManager-Files-Import'); // not in FileManager anymore
    }

    /**
     * Dateien entfernen und speichern.
     */
    public function testDeleteFileSave() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/index/id/160');

        $this->assertElementPresent('FileLink-140');

        $this->openAndWait('/admin/filemanager/index/id/160');

        $this->assertElementContainsText('//div[@class="breadcrumbsContainer"]', 'Files');
        $this->assertElementContainsText('//div[@id="docinfo"]', '160');

        $this->assertElementPresent('FileManager-Files-File0-Remove');
        $this->assertElementNotPresent('FileManager-Files-File1-Remove'); // only one file

        $this->clickAndWait('FileManager-Files-File0-Remove');

        $this->assertElementNotPresent('FileManager-Files-File0-Remove');

        $this->clickAndWait('FileManager-Action-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'File information successfully stored!');
        $this->assertElementNotPresent('FileLink-140');
        $this->assertElementNotPresent('fieldset-Files'); // not in FileManager anymore
        $this->assertElementNotPresent('FileManager-Files-Import'); // not in FileManager anymore
   }

}