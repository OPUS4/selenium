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
 * @category    Unit Test
 * @package     Module_Admin
 * @author      Jens Schwidder <schwidder@zib.de>
 * @copyright   Copyright (c) 2008-2011, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class TitleTest extends TestCase {

    const SUCCESS_MESSAGE = 'Changes successfully saved.';

    
    /**
     * Test for OPUSVIER-2172.
     */
    public function testCreatingTitleWithValue0() {
        $this->switchToEnglish();
        $this->login();

        // check output
        $this->openAndWait('/admin/document/edit/id/30');
        
        $this->assertElementNotPresent('Document-Titles-Main-TitleMain1-Value');

        $this->click('Document-Titles-Main-Add');
        $this->waitForPageToLoad();

        $this->assertElementPresent('Document-Titles-Main-TitleMain1-Value');
        
        $this->select('Document-Titles-Main-TitleMain1-Language', 'value=eng');
        $this->type('Document-Titles-Main-TitleMain1-Value', '0');
        
        $this->click('Document-ActionBox-Save');
        $this->waitForPageToLoad();
        
        $this->assertElementPresent('Document-Titles-Main-TitleMain1-Value');
        $this->assertElementContainsText('Document-Titles-Main-TitleMain1-Language', 'English');
        $this->assertElementContainsText('Document-Titles-Main-TitleMain1-Value', '0');
    }
    
    public function testTitleValidation() {
        $this->switchToEnglish();
        $this->login();
        
        $this->openAndWait('/admin/document/edit/id/250');
        
        $this->assertElementPresent('Document-Titles-Main-TitleMain0-Value');
        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Language', 'deu');
        $this->assertElementPresent('Document-Titles-Main-Add');
        
        $this->clickAndWait('Document-Titles-Main-Add');
        
        $this->assertElementPresent('Document-Titles-Main-TitleMain1-Language');
        
        $this->clickAndWait('Document-Titles-Main-Add');
        
        $this->assertElementPresent('Document-Titles-Main-TitleMain2-Language');
        
        $this->select('Document-General-Language', 'Russian');
        $this->select('Document-Titles-Main-TitleMain1-Language', 'German');
        $this->type('Document-Titles-Main-TitleMain1-Value', 'Titel 2');
        $this->select('Document-Titles-Main-TitleMain2-Language', 'English');
        
        $this->clickAndWait('Document-ActionBox-Save');
        
        // Globale Validerungsfehler-Nachricht
        $this->assertElementPresent('xpath=//div[@class="messagesContainer"]/div[@class="messages"]');
        $this->assertElementContainsText('xpath=//div[@class="messagesContainer"]/div[@class="messages"]', 
                'Document cannot be saved, because some input is not valid.');
        
        // Fehlermeldung für fehlenden Titel in Russisch (Dokumentensprache)
        $this->assertElementPresent('xpath=//ul[@class="form-errors"]/ul[@class="errors"]/li');
        $this->assertElementContainsText('xpath=//ul[@class="form-errors"]/ul[@class="errors"]/li', 
                'A title in the document language \'Russian\' is required.');
        
        // Fehlermeldung für zweiten Titel in Deutsch
        $this->assertElementPresent('xpath=//*[@id="Document-Titles-Main-TitleMain1-Language-element"]/ul/li');
        $this->assertElementContainsText('xpath=//*[@id="Document-Titles-Main-TitleMain1-Language-element"]/ul/li',
                'Languages can only be used once.');

        // Fehlermeldung für leeren Titel
        $this->assertElementPresent('xpath=//div[@id="Document-Titles-Main-TitleMain2-Value-element"]/ul/li');
        $this->assertElementContainsText('xpath=//div[@id="Document-Titles-Main-TitleMain2-Value-element"]/ul/li',
                'Value is required and can\'t be empty.');   
    }
    
    public function testAddTitle() {
        $this->switchToEnglish();
        $this->login();
        
        $this->openAndWait('/admin/document/edit/id/250');
        
        $this->assertElementPresent('Document-Titles-Main-TitleMain0-Value');
        $this->assertElementValueEquals('Document-Titles-Main-TitleMain0-Language', 'deu');
        $this->assertElementPresent('Document-Titles-Main-Add');
        
        $this->clickAndWait('Document-Titles-Main-Add');
        
        $this->assertElementPresent('Document-Titles-Main-TitleMain1-Language');
        $this->select('Document-Titles-Main-TitleMain1-Language', 'Spanish');
        $this->type('Document-Titles-Main-TitleMain1-Value', 'Title 2');
        
        $this->clickAndWait('Document-ActionBox-Save');
        
        $this->assertElementContainsText('//*[@id="content"]/div[@class="messages"]/div[@class="notice"]', 
                self::SUCCESS_MESSAGE);

        $this->assertElementPresent('Document-Titles-Main-TitleMain1-Value');
        $this->assertElementContainsText('Document-Titles-Main-TitleMain1-Language', 'Spanish');
        $this->assertElementContainsText('Document-Titles-Main-TitleMain1-Value', 'Title 2');
    }

}
