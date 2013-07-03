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

    public function testAddSeriesToDocument() {
        $this->markTestIncomplete('Not complete yet.');

        $this->login();

        // check output
        $this->open('/admin/document/add/id/50/section/series');
        $this->waitForPageToLoad('30000');
        $this->type('Opus_Series-Number', 'III');
        $this->type('Opus_Series-SortOrder', '8');
        $this->type('Opus_Title-Series', 'value=2');
        $this->clickAndWait('Opus_Series-submit_add');
        $this->assertElementValueEquals('Series-0-Number', 'III');
        $this->assertElementValueEquals('Series-0-Series', '2');
        $this->assertElementValueEquals('Series-0-Number', 'III');
        $this->assertElementValueEquals('Series-0-SortOrder', '8');
        $this->assertElementPresent('save');
    }

    /**
     * @dependsOn testAddSeriesToDocument
     *
     * TODO add specific test document for removing a series
     */
    public function testRemoveSeriesFromDocument() {
        $this->markTestIncomplete('Not complete yet.');
    }

    public function testTryToAddSeriesWithoutNumber() {
        $this->markTestIncomplete('Not complete yet.');
    }

    public function testTryToAddSeriesWithoutSortOrder() {
        $this->markTestIncomplete('Not complete yet.');
    }

    public function testTryToAddSeriesWithInvalidInput() {
        $this->markTestIncomplete('Not complete yet.');
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
