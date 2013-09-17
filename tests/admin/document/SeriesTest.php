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
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class SeriesTest extends TestCase {

    /**
     * Schriftenreihe zu einem Dokument hinzufügen und wieder entfernen. DocSortOrder wird automatisch gesetzt.
     */
    public function testAddSeriesToDocument() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');

        $this->assertElementNotPresent('Document-Series-Series0-SeriesId');

        $this->clickAndWait('Document-Series-Add');

        $this->assertElementPresent('Document-Series-Series0-SeriesId');

        $this->select('Document-Series-Series0-SeriesId', 'Foobar Series');
        $this->type('Document-Series-Series0-Number', 'T9');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementContainsText('Document-Series-Series0-SeriesId', 'Foobar Series');
        $this->assertElementContainsText('Document-Series-Series0-Number', 'T9');
        $this->assertElementContainsText('Document-Series-Series0-SortOrder', '4');

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementPresent('Document-Series-Series0-SeriesId');
        $this->assertElementValueEquals('Document-Series-Series0-SeriesId', 2);

        $this->clickAndWait('Document-Series-Series0-Remove');

        $this->assertElementNotPresent('Document-Series-Series0-SeriesId');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementNotPresent('fieldset-Series');
        $this->assertElementNotPresent('Document-Series-Series0-SeriesId');
    }

    public function testRegression2355ModifySortOrderForDocument() {
        $this->login();

        $this->openAndWait('/admin/document/edit/id/92');

        $this->assertElementValueEquals('Document-Series-Series2-SortOrder', '1');
        $this->type('Document-Series-Series2-SortOrder', '2');
        $this->clickAndWait('Document-ActionBox-Save');

        $this->openAndWait('/admin/document/edit/id/92');

        $this->assertElementValueEquals('Document-Series-Series2-SortOrder', '2');

        $this->type('Document-Series-Series2-SortOrder', '1');
        $this->click('Document-ActionBox-Save');

        $this->openAndWait('/admin/document/edit/id/92');

        $this->assertElementValueEquals('Document-Series-Series2-SortOrder', '1');

        $this->logout();
    }

}
