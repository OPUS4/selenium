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
 * @category    Application
 * @package     Selenium Test
 * @author      Michael Lang <lang@zib.de>
 * @copyright   Copyright (c) 2008-2014, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class Opusvier3043Test extends TestCase {

    /**
     * Collections with the property visible_publish==0 (like 'Serviceeinrichtungen') and visible==0 (like 'Maschinenbau)
     * should not be shown in the select-boxes of publish form.
     */
    public function testVisiblePublishFalseCollectionsNotShown() {
        $this->switchToEnglish();
        $this->open("/publish");
        $this->waitForPageToLoad();
        $this->select("documentType", "label=All fields (testing documenttype)");
        $this->click("rights");
        $this->click("send");
        $this->waitForPageToLoad();

        $this->select('Institute_1', 'label=Technische Universität Hamburg-Harburg');
        $this->click('browseDownInstitute');
        $this->waitForPageToLoad();

        $this->assertTrue($this->isTextPresent("Bauwesen"));
        $this->assertTrue($this->isTextPresent("Verfahrenstechnik"));
        $this->assertFalse($this->isTextPresent("Serviceeinrichtungen"));
        $this->assertFalse($this->isTextPresent("Elektrotechnik und Informationstechnik"));
    }


}
