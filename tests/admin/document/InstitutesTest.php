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

class InstitutesTest extends TestCase {

    public function testModifyGrantor() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');

        $this->assertElementNotPresent('Document-Bibliographic-Grantors-ThesisGrantor0-Institute');

        $this->clickAndWait('Document-Bibliographic-Grantors-Add');

        $this->assertElementPresent('Document-Bibliographic-Grantors-ThesisGrantor0-Institute');
        $this->assertElementNotPresent('Document-Bibliographic-Grantors-ThesisGrantor1-Institute');

        $this->clickAndWait('Document-Bibliographic-Grantors-Add');

        $this->assertElementPresent('Document-Bibliographic-Grantors-ThesisGrantor0-Institute');
        $this->assertElementPresent('Document-Bibliographic-Grantors-ThesisGrantor1-Institute');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementPresent('Document-Bibliographic-Grantors-ThesisGrantor0-Institute');
        $this->assertElementPresent('Document-Bibliographic-Grantors-ThesisGrantor1-Institute');
        $this->assertElementContainsText(
            '//div[@id="Document-Bibliographic-Grantors-ThesisGrantor1-Institute-element"]/ul[@class="errors"]/li',
            'only be assigned once');

        $this->select('Document-Bibliographic-Grantors-ThesisGrantor1-Institute', 'School of Life');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementContainsText('Document-Bibliographic-Grantors-ThesisGrantor0-Institute',
            'Foobar Universität');
        $this->assertElementContainsText('Document-Bibliographic-Grantors-ThesisGrantor1-Institute',
            'School of Life');

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementPresent('Document-Bibliographic-Grantors-ThesisGrantor0-Institute');
        $this->assertElementValueEquals('Document-Bibliographic-Grantors-ThesisGrantor0-Institute', 1); // 'Foobar ...'
        $this->assertElementPresent('Document-Bibliographic-Grantors-ThesisGrantor1-Institute');
        $this->assertElementValueEquals('Document-Bibliographic-Grantors-ThesisGrantor1-Institute', 4); // 'School ...'

        $this->clickAndWait('Document-Bibliographic-Grantors-ThesisGrantor0-Remove');

        $this->assertElementPresent('Document-Bibliographic-Grantors-ThesisGrantor0-Institute');
        $this->assertElementValueEquals('Document-Bibliographic-Grantors-ThesisGrantor0-Institute', 4); // 'School ...'
        $this->assertElementNotPresent('Document-Bibliographic-Grantors-ThesisGrantor1-Institute');

        $this->clickAndWait('Document-Bibliographic-Grantors-ThesisGrantor0-Remove');

        $this->assertElementNotPresent('Document-Bibliographic-Grantors-ThesisGrantor0-Institute');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementNotPresent('Document-Bibliographic-Grantors-ThesisGrantor0-Institute');
        $this->assertElementNotPresent('Document-Bibliographic-Grantors-ThesisGrantor1-Institute');
    }

    public function testModifyPublisher() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');

        $this->assertElementNotPresent('Document-Bibliographic-Publishers-ThesisPublisher0-Institute');

        $this->clickAndWait('Document-Bibliographic-Publishers-Add');

        $this->assertElementPresent('Document-Bibliographic-Publishers-ThesisPublisher0-Institute');
        $this->assertElementNotPresent('Document-Bibliographic-Publishers-ThesisPublisher1-Institute');

        $this->clickAndWait('Document-Bibliographic-Publishers-Add');

        $this->assertElementPresent('Document-Bibliographic-Publishers-ThesisPublisher0-Institute');
        $this->assertElementPresent('Document-Bibliographic-Publishers-ThesisPublisher1-Institute');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementPresent('Document-Bibliographic-Publishers-ThesisPublisher0-Institute');
        $this->assertElementPresent('Document-Bibliographic-Publishers-ThesisPublisher1-Institute');
        $this->assertElementContainsText(
            '//div[@id="Document-Bibliographic-Publishers-ThesisPublisher1-Institute-element"]/ul[@class="errors"]/li',
            'only be assigned once');

        $this->select('Document-Bibliographic-Publishers-ThesisPublisher1-Institute', 'School of Life');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementContainsText('Document-Bibliographic-Publishers-ThesisPublisher0-Institute',
            'Foobar Universitätsbibliothek');
        $this->assertElementContainsText('Document-Bibliographic-Publishers-ThesisPublisher1-Institute',
            'School of Life');

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementPresent('Document-Bibliographic-Publishers-ThesisPublisher0-Institute');
        $this->assertElementValueEquals('Document-Bibliographic-Publishers-ThesisPublisher0-Institute', 2);
        $this->assertElementPresent('Document-Bibliographic-Publishers-ThesisPublisher1-Institute');
        $this->assertElementValueEquals('Document-Bibliographic-Publishers-ThesisPublisher1-Institute', 4);

        $this->clickAndWait('Document-Bibliographic-Publishers-ThesisPublisher0-Remove');

        $this->assertElementPresent('Document-Bibliographic-Publishers-ThesisPublisher0-Institute');
        $this->assertElementValueEquals('Document-Bibliographic-Publishers-ThesisPublisher0-Institute', 4);
        $this->assertElementNotPresent('Document-Bibliographic-Publishers-ThesisPublisher1-Institute');

        $this->clickAndWait('Document-Bibliographic-Publishers-ThesisPublisher0-Remove');

        $this->assertElementNotPresent('Document-Bibliographic-Publishers-ThesisPublisher0-Institute');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementNotPresent('Document-Bibliographic-Publishers-ThesisPublisher0-Institute');
        $this->assertElementNotPresent('Document-Bibliographic-Publishers-ThesisPublisher1-Institute');
    }

}