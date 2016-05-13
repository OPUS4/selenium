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
 * @copyright   Copyright (c) 2008-2011, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class DisabledMiddleCollectionNodeTest extends TestCase {

    public function testDisabledMiddleAndRootCollectionNodes() {
        $this->switchToGerman();
        $this->openAndWait("/publish");

        $this->assertTrue($this->isElementPresent("link=English"));

        $this->select("id=documentType", "value=all");
        $this->click("id=rights");
        $this->clickAndWait("id=send");

        $this->type("id=PersonAuthorFirstName_1", "Susi");
        $this->type("id=PersonAuthorLastName_1", "Gottwald");
        $this->type("id=TitleMain_1", "Entenhausen");
        $this->type("id=TitleAbstract_1", "bla");
        $this->select("id=Institute_1", "label=Technische Universität Hamburg-Harburg");
        $this->select("id=SubjectMSC_1", "label=00-XX GENERAL");
        $this->clickAndWait("id=browseDownInstitute");

        $this->clickAndWait("id=browseDownInstitute");

        $this->clickAndWait("id=browseDownSubjectMSC");

        $this->select("id=collId2SubjectMSC_1", "label=00Axx General and miscellaneous specific topics");
        $this->clickAndWait("id=browseDownSubjectMSC");

        $this->assertFalse($this->isEditable("id=SubjectMSC_1"));
        $this->assertFalse($this->isEditable("id=collId2SubjectMSC_1"));
        $this->assertFalse($this->isEditable("id=Institute_1"));
        $this->assertFalse($this->isEditable("id=collId2Institute_1"));
        $this->click("id=LegalNotices");
        $this->clickAndWait("id=send");

        $this->assertTextPresent("00A05 General mathematics");
        $this->assertTextPresent("Abwasserwirtschaft und Gewässerschutz B-2");
        $this->assertTextNotPresent("Technische Universität Hamburg-Harburg");
        $this->assertTextNotPresent("00-XX GENERAL");
        $this->assertTextNotPresent("00Axx General and miscellaneous specific topics");
        $this->assertTextNotPresent("Bauwesen");
    }

}

?>
