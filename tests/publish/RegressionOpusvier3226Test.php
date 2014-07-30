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
 * @package     Module_Publish
 * @author      Jens Schwidder <schwidder@zib.de>
 * @copyright   Copyright (c) 2008-2014, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class RegressionOpusvier3226Test extends TestCase {

    public function testDepositWithMissingModelDnbInstitute() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/publish');

        $this->click('rights');
        $this->clickAndWait('send');

        $this->assertElementPresent('//div[@class = "form-item"]/div[@class = "form-errors"]');
        $this->assertElementContainsText('//div[@class = "form-item"]/div[@class = "form-errors"]',
            'missing document type');

        $this->select('documentType', 'value=all');

        $this->clickAndWait('send'); // Go to metadate (2nd) page

        $this->click('LegalNotices');

        $this->clickAndWait('send'); // Go to verification page

        $this->clickAndWait('send'); // Save document

        $this->clickAndWait('frontdoor-link'); // Go to frontdoor

        $this->assertElementPresent('//div[@class = "frontdoor"]');

        $this->assertElementContainsText('//table[@class = "result-data frontdoordata"]', 'Document Type:');
    }

}