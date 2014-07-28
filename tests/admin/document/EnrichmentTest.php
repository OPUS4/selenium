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

class EnrichmentTest extends TestCase {

    public function testModifyEnrichments() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementContainsText('//div[@id="docinfo"]', 'Testdokument fuer ');
        $this->assertElementContainsText('//div[@id="docinfo"]', '250');

        $this->assertElementNotPresent('Document-Enrichments-Enrichment0-Value');

        $this->clickAndWait('Document-Enrichments-Add');

        $this->assertElementPresent('Document-Enrichments-Enrichment0-Value');
        $this->assertElementNotPresent('Document-Enrichments-Enrichment1-Value');

        $this->clickAndWait('Document-Enrichments-Add');

        $this->assertElementPresent('Document-Enrichments-Enrichment0-Value');
        $this->assertElementPresent('Document-Enrichments-Enrichment1-Value');

        $this->type('Document-Enrichments-Enrichment0-Value', 'Testwert');
        $this->type('Document-Enrichments-Enrichment1-Value', 'Testwert');

        $this->select('Document-Enrichments-Enrichment0-KeyName', 'City of event');
        $this->select('Document-Enrichments-Enrichment1-KeyName', 'City of event');

        $this->clickAndWait('Document-ActionBox-Save'); // zweimal selben KeyName und Wert abspeichern

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementPresent('Document-Enrichments-Enrichment0-Value');
        $this->assertElementContainsText('Document-Enrichments-Enrichment0-KeyName', 'City of event');
        $this->assertElementContainsText('Document-Enrichments-Enrichment0-Value', 'Testwert');
        $this->assertElementPresent('Document-Enrichments-Enrichment1-Value');
        $this->assertElementContainsText('Document-Enrichments-Enrichment1-KeyName', 'City of event');
        $this->assertElementContainsText('Document-Enrichments-Enrichment1-Value', 'Testwert');

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementPresent('Document-Enrichments-Enrichment0-Value');
        $this->assertElementValueEquals('Document-Enrichments-Enrichment0-KeyName', 'City of event');
        $this->assertElementValueEquals('Document-Enrichments-Enrichment0-Value', 'Testwert');
        $this->assertElementPresent('Document-Enrichments-Enrichment1-Value');
        $this->assertElementValueEquals('Document-Enrichments-Enrichment1-KeyName', 'City of event');
        $this->assertElementValueEquals('Document-Enrichments-Enrichment1-Value', 'Testwert');

        $this->select('Document-Enrichments-Enrichment0-KeyName', 'BibtexRecord');
        $this->type('Document-Enrichments-Enrichment0-Value', 'Testwert 1');
        $this->type('Document-Enrichments-Enrichment1-Value', 'Testwert 2');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementPresent('Document-Enrichments-Enrichment0-Value');
        $this->assertElementContainsText('Document-Enrichments-Enrichment0-KeyName', 'BibtexRecord');
        $this->assertElementContainsText('Document-Enrichments-Enrichment0-Value', 'Testwert 1');
        $this->assertElementPresent('Document-Enrichments-Enrichment1-Value');
        $this->assertElementContainsText('Document-Enrichments-Enrichment1-KeyName', 'City of event');
        $this->assertElementContainsText('Document-Enrichments-Enrichment1-Value', 'Testwert 2');

        $this->openAndWait('/admin/document/edit/id/250');

        $this->assertElementPresent('Document-Enrichments-Enrichment0-Value');
        $this->assertElementValueEquals('Document-Enrichments-Enrichment0-KeyName', 'BibtexRecord');
        $this->assertElementValueEquals('Document-Enrichments-Enrichment0-Value', 'Testwert 1');
        $this->assertElementPresent('Document-Enrichments-Enrichment1-Value');
        $this->assertElementValueEquals('Document-Enrichments-Enrichment1-KeyName', 'City of event');
        $this->assertElementValueEquals('Document-Enrichments-Enrichment1-Value', 'Testwert 2');

        $this->clickAndWait('Document-Enrichments-Enrichment0-Remove');

        $this->assertElementPresent('Document-Enrichments-Enrichment0-Value');
        $this->assertElementValueEquals('Document-Enrichments-Enrichment0-KeyName', 'City of event');
        $this->assertElementValueEquals('Document-Enrichments-Enrichment0-Value', 'Testwert 2');
        $this->assertElementNotPresent('Document-Enrichments-Enrichment1-Value');

        $this->clickAndWait('Document-Enrichments-Enrichment0-Remove');

        $this->assertElementNotPresent('Document-Enrichments-Enrichment0-Value');
        $this->assertElementNotPresent('Document-Enrichments-Enrichment1-Value');

        $this->clickAndWait('Document-ActionBox-Save');

        $this->assertElementContainsText('//div[@class="notice"]', 'Changes successfully saved.');
        $this->assertElementNotPresent('fieldset-Enrichments');
        $this->assertElementNotPresent('Document-Enrichments-Enrichment0-Value');
        $this->assertElementNotPresent('Document-Enrichments-Enrichment1-Value');
    }

}