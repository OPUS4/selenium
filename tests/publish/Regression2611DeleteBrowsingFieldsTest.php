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
 * @package     Module_Publish
 * @author      Susanne Gottwald <gottwald@zib.de>
 * @copyright   Copyright (c) 2008-2013, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class Regression2611DeleteBrowsingFieldsTest extends TestCase {

    public function testDeleteAndAddMscFields() {
        $this->switchToGerman();

        $this->open("/publish");
        $this->waitForPageToLoad();

        $this->select("id=documentType", "label=Preprint für MATHEON");
        $this->click("id=rights");
        $this->click("id=send");
        $this->waitForPageToLoad();

        $this->assertTextPresent("MSC");
        $this->select("id=SubjectMSC_1", "label=01-XX HISTORY AND BIOGRAPHY [See also the classification number -03 in the other sections]");
        $this->click("id=browseDownSubjectMSC");
        $this->waitForPageToLoad();

        $this->select("id=collId2SubjectMSC_1", "label=01Axx History of mathematics and mathematicians");
        $this->click("id=browseDownSubjectMSC");
        $this->waitForPageToLoad();

        $this->select("id=collId3SubjectMSC_1", "label=01A70 Biographies, obituaries, personalia, bibliographies");
        $this->click("id=addMoreSubjectMSC");
        $this->waitForPageToLoad();

        $this->assertTextPresent("01A70");
        $this->assertElementPresent("id=SubjectMSC_2");
        $this->assertTrue($this->isEditable("id=SubjectMSC_2"));
        $this->select("id=SubjectMSC_2", "label=05-XX COMBINATORICS (For finite fields, see 11Txx)");
        $this->click("id=browseDownSubjectMSC");
        $this->waitForPageToLoad();

        $this->assertTextPresent("01A70");
        $this->select("id=collId2SubjectMSC_2", "label=05Bxx Designs and configurations (For applications of design theory, see 94C30)");
        $this->click("id=browseDownSubjectMSC");
        $this->waitForPageToLoad();

        $this->assertTextPresent("01A70");
        $this->assertTextPresent("05B05");
        $this->click("id=deleteMoreSubjectMSC");
        $this->waitForPageToLoad();

        $this->assertTextPresent("01A70");
        $this->assertTextNotPresent("05B05");
        $this->click("id=addMoreSubjectMSC");
        $this->waitForPageToLoad();

        $this->assertTextPresent("01A70");
        $this->assertElementPresent("id=SubjectMSC_2");
        $this->assertTrue($this->isEditable("id=SubjectMSC_2"));
        $this->select("id=SubjectMSC_2", "label=05-XX COMBINATORICS (For finite fields, see 11Txx)");
        $this->click("id=browseDownSubjectMSC");
        $this->waitForPageToLoad();

        $this->assertTextPresent("01A70");
        $this->select("id=collId2SubjectMSC_2", "label=05Bxx Designs and configurations (For applications of design theory, see 94C30)");
        $this->click("id=browseDownSubjectMSC");
        $this->waitForPageToLoad();

        $this->assertTextPresent("01A70");
        $this->assertTextPresent("05B05");
        $this->click('abort');
    }

}

?>