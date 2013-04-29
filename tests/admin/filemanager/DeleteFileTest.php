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

    public function testDeleteFileConfirmNo() {
        $this->switchToEnglish();
        $this->login();

        // check output
        $this->openAndWait('/admin/filemanager/delete/docId/124/fileId/125');
        
        // check correct page
        $this->assertElementContainsText('//html/head/title', 'Delete this File');
        $this->assertElementContainsText('//div[@id="docinfo"]', '124');
        
        // click no
        $this->click('sureno');
        $this->waitForPageToLoad();
        
        // check back to file manager
        $this->assertElementContainsText('//html/head/title', 'Files');
        $this->assertElementContainsText('//div[@id="docinfo"]', '124');
        $this->assertElementPresent("//a[@href='{$this->browserUrl}{$this->baseUrl}/files/124/bar.html']");

        $this->logout();
    }
    
    public function testDeleteFileConfirmYes() {
        $this->switchToEnglish();
        $this->login();

        // check output
        $this->openAndWait('/admin/filemanager/delete/docId/160/fileId/140');
        
        // check correct page
        $this->assertElementContainsText('//html/head/title', 'Delete this File');
        $this->assertElementContainsText('//div[@id="docinfo"]', '160');
        
        // click yes
        $this->click('sureyes');
        $this->waitForPageToLoad();
        
        // check back to file manager
        $this->assertElementContainsText('//html/head/title', 'Files');
        $this->assertElementContainsText('//div[@id="docinfo"]', '160');
        $this->assertElementNotPresent("//a[@href='{$this->browserUrl}{$this->baseUrl}/files/140/bar.html']");

        $this->logout();
    }
    
    public function testBadDocIdErrorMessage() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/filemanager/delete/docId/1039/fileId/125');
        
        $this->assertElementContainsText('//div[@class="failure"]', 'No valid document ID provided.');
        
        $this->logout();
    }
    
    public function testBadFileIdErrorMessage() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/filemanager/delete/docId/124/fileId/400');
        
        $this->assertElementContainsText('//div[@class="failure"]', 'No valid file ID provided.');
        
        $this->logout();        
    }
    
    public function testFileDoesNotBelongToDocErrorMessage() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/filemanager/delete/docId/146/fileId/125');
        
        $this->assertElementContainsText('//div[@class="failure"]', 'File does not belong to document.');
        
        $this->logout();
    }
    
    public function testBadDocIdNotDisplayedOnPage() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/filemanager/delete/docId/dummyDocId/fileId/125');
        
        $this->assertTextNotPresent('dummyDocId');
        
        $this->logout();        
    }
    
    public function testBadFileIdNotDisplayedOnPage() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/filemanager/delete/docId/124/fileId/dummyFileId');
        
        $this->assertTextNotPresent('dummyFieldId');
        
        $this->logout();        
    }

}