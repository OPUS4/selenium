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
 * Class FilemanagerTest
 *
 * Keinen Weg für Upload-Tests gefunden.
 */
class FilemanagerTest extends TestCase {

    /**
     * Speichern von Dokument 122 mit fehlender Datei schlägt fehl und der FileManager wird wieder angezeigt. Nach dem
     * Speichern müsste das Metadaten-Formular angezeigt werden.
     */
    public function testRegression3120SaveDocumentWithMissingFile () {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/filemanager/index/id/122');

        $this->assertElementPresent('FileManager-Files-File0-FileLink');
        $this->assertElementContainsText('FileManager-Files-File0-FileLink-element',
            'Datei_unsichtaber_in_Frontdoor.pdf');
        $this->assertElementPresent('FileManager-Files-File0-FileSize-element');
        $this->assertElementContainsText('FileManager-Files-File0-FileSize-element', '70.9 KB');

        $this->clickAndWait('FileManager-Action-Save');

        $this->assertElementNotPresent('FileManager-Files-File0-FileSize-element');
        $this->assertElementContainsText('//div[@class="notice"]', 'File information successfully stored!');

        $this->logout();
    }

    public function testKeepChangesWhenAddCancel() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/filemanager/index/id/91');

        $this->assertElementValueEquals('FileManager-Files-File0-Label', 'test.pdf');
        $this->assertElementPresent('FileManager-Files-File0-Remove');

        $this->type('FileManager-Files-File0-Label', 'newlabel.pdf');

        $this->clickAndWait('FileManager-Files-Add');

        $this->assertElementContainsText('//label', 'File to upload');
        $this->assertElementPresent('File');
        $this->assertElementPresent('Cancel');

        $this->clickAndWait('Cancel');

        $this->assertElementValueEquals('FileManager-Files-File0-Label', 'newlabel.pdf');
        $this->assertElementPresent('FileManager-Files-File0-Remove');

        $this->logout();
    }

}