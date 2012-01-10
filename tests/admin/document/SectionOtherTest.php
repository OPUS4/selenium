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

class SectionOtherTest extends TestCase {

    /**
     * Test for OPUSVIER-2172.
     */
    public function testSavinPageAttributesWithValue0() {
        $this->login();

        // check output
        $this->open('/opus4-selenium/admin/document/edit/id/30/section/other');
        $this->waitForPageToLoad('30000');
        $this->type('Opus_Document-PageFirst', '0');
        $this->type('Opus_Document-PageLast', '0');
        $this->type('Opus_Document-PageNumber', '0');
        $this->click('save');
        $this->waitForPageToLoad(30000);
        $this->assertElementValueNotEquals('Opus_Document-PageFirst', '');
        $this->assertElementValueEquals('Opus_Document-PageFirst', '0');
        $this->assertElementValueNotEquals('Opus_Document-PageLast', '');
        $this->assertElementValueEquals('Opus_Document-PageLast', '0');
        $this->assertElementValueNotEquals('Opus_Document-PageNumber', '');
        $this->assertElementValueEquals('Opus_Document-PageNumber', '0');
    }

}