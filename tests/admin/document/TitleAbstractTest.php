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
 * @category    Application Unit Test
 * @package     Module_Admin
 * @author      Jens Schwidder <schwidder@zib.de>
 * @copyright   Copyright (c) 2008-2013, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class TitleAbstractTest extends TestCase {

    public function testModifyAbstract() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');

        $this->assertElementNotPresent('Document-Content-Abstracts-TitleAbstract0-Value');

        $this->clickAndWait('Document-Content-Abstracts-Add');

        $this->assertElementPresent('Document-Content-Abstracts-TitleAbstract0-Value');
        $this->assertElementNotPresent('Document-Content-Abstracts-TitleAbstract1-Value');

        $this->clickAndWait('Document-Content-Abstracts-Add');

        $this->assertElementPresent('Document-Content-Abstracts-TitleAbstract0-Value');
        $this->assertElementPresent('Document-Content-Abstracts-TitleAbstract1-Value');

        $this->type('Document-Content-Abstracts-TitleAbstract0-Value', 'Testzusammenfassung 1');
        $this->type('Document-Content-Abstracts-TitleAbstract1-Value', 'Testzusammenfassung 2');

        $this->clickAndWait('Document-ActionBox-Save'); // Validierung schlägt fehl (zweimal selbe Sprache)

        $this->assertElementPresent('Document-Content-Abstracts-TitleAbstract0-Value');
        $this->assertElementContainsText('Document-Content-Abstracts-TitleAbstract0-Value', 'Testzusammenfassung 1');
        $this->assertElementPresent('Document-Content-Abstracts-TitleAbstract1-Value');
        $this->assertElementContainsText('Document-Content-Abstracts-TitleAbstract1-Value', 'Testzusammenfassung 2');
        $this->assertElementContainsText(
            '//div[@id="Document-Content-Abstracts-TitleAbstract1-Language-element"]/ul[@class="errors"]/li',
            'Languages can only be used once.');

        $this->select('Document-Content-Abstracts-TitleAbstract1-Language', 'French');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementContainsText('Document-Content-Abstracts-TitleAbstract0-Language', 'German');
        $this->assertElementContainsText('Document-Content-Abstracts-TitleAbstract0-Value', 'Testzusammenfassung 1');
        $this->assertElementContainsText('Document-Content-Abstracts-TitleAbstract1-Language', 'French');
        $this->assertElementContainsText('Document-Content-Abstracts-TitleAbstract1-Value', 'Testzusammenfassung 2');

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementPresent('Document-Content-Abstracts-TitleAbstract0-Value');
        $this->assertElementValueEquals('Document-Content-Abstracts-TitleAbstract0-Language', 'deu');
        $this->assertElementValueEquals('Document-Content-Abstracts-TitleAbstract0-Value', 'Testzusammenfassung 1');
        $this->assertElementPresent('Document-Content-Abstracts-TitleAbstract1-Value');
        $this->assertElementValueEquals('Document-Content-Abstracts-TitleAbstract1-Language', 'fra');
        $this->assertElementValueEquals('Document-Content-Abstracts-TitleAbstract1-Value', 'Testzusammenfassung 2');

        $this->clickAndWait('Document-Content-Abstracts-TitleAbstract0-Remove');

        $this->assertElementPresent('Document-Content-Abstracts-TitleAbstract0-Value');
        $this->assertElementValueEquals('Document-Content-Abstracts-TitleAbstract0-Language', 'fra');
        $this->assertElementValueEquals('Document-Content-Abstracts-TitleAbstract0-Value', 'Testzusammenfassung 2');
        $this->assertElementNotPresent('Document-Content-Abstracts-TitleAbstract1-Value');

        $this->clickAndWait('Document-Content-Abstracts-TitleAbstract0-Remove');

        $this->assertElementNotPresent('Document-Content-Abstracts-TitleAbstract0-Value');
        $this->assertElementNotPresent('Document-Content-Abstracts-TitleAbstract1-Value');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementNotPresent('fieldset-Abstracts');
        $this->assertElementNotPresent('Document-Content-Abstracts-TitleAbstract0-Value');
        $this->assertElementNotPresent('Document-Content-Abstracts-TitleAbstract1-Value');
    }

}