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

class BibliographicTest extends TestCase {

    private $values = array(
        'Edition' => '1',
        'Volume' => '2',
        'PublisherName' => 'Foo Publishing',
        'PublisherPlace' => 'Timbuktu',
        'PageCount' => '4',
        'PageFirst' => '1',
        'PageLast' => '4',
        'Issue' => '3',
        'ContributingCorporation' => 'Baz University',
        'CreatingCorporation' => 'Bar University',
        'ThesisDateAccepted' => '2010/11/02',
        'ThesisYearAccepted' => '1999',
        'BelongsToBibliography' => 'on'
    );

    private $changedValues = array(
        'Edition' => '4th',
        'Volume' => '24',
        'PublisherName' => 'Opus Internal Publishing',
        'PublisherPlace' => 'Berlin',
        'PageCount' => '4',
        'PageFirst' => 'I',
        'PageLast' => 'IV',
        'Issue' => '2008-A',
        'ContributingCorporation' => 'Test Universität',
        'CreatingCorporation' => 'TestIt University',
        'ThesisDateAccepted' => '2008/05/07',
        'ThesisYearAccepted' => '2004',
        'BelongsToBibliography' => 'off'
    );

    /**
     * Test für bibliographische Informationen. ThesisGrantor und -Publisher werden separat (InstitutesTest) getestet.
     */
    public function testModifyBibliographicInformation() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');

        foreach ($this->values as $name => $value) {
            $this->assertElementValueEquals("Document-Bibliographic-$name", $value,
                "Element '$name' should have value '$value'.");
        }

        foreach ($this->changedValues as $name => $value) {
            if ($name !== 'BelongsToBibliography') {
                $this->type("Document-Bibliographic-$name", $value);
            }
            else {
                $this->uncheck("Document-Bibliographic-$name");
            }
        }

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');

        foreach ($this->changedValues as $name => $value) {
            if ($name === 'BelongsToBibliography') {
                $value = 'No'; // Übersetzter Anzeigewert
            }
            $this->assertElementContainsText("Document-Bibliographic-$name", $value,
                "Element '$name' should contain text '$value'.");
        }

        $this->openAndWait('/admin/document/edit/id/250');

        foreach ($this->values as $name => $value) {
            if ($name !== 'BelongsToBibliography') {
                $this->type("Document-Bibliographic-$name", $value);
            }
            else {
                $this->check("Document-Bibliographic-$name");
            }
        }

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');

        foreach ($this->values as $name => $value) {
            if ($name === 'BelongsToBibliography') {
                $value = 'Yes'; // Übersetzter Anzeigewert
            }
            $this->assertElementContainsText("Document-Bibliographic-$name", $value,
                "Element '$name' should contain text '$value'.");
        }
    }

}