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
 * @package     Module_Publish Selenium Test MATHEON
 * @author      Susanne Gottwald <gottwald@zib.de>
 * @copyright   Copyright (c) 2008-2011, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class BrowseCollectionDdcTest extends TestCase {

    public function testAllDocumentType() {
        $this->open("/opus4-selenium");
        $this->waitForPageToLoad("30000");
        $this->open("/opus4-selenium/home/index/language/language/de");
        $this->waitForPageToLoad("30000");
        $this->open("/opus4-selenium/publish");
        $this->click("//li[@id='primary-nav-publish']/a/em/span");
        $this->waitForPageToLoad("30000");
        $this->assertTrue($this->isElementPresent("link=English"));
        $this->select("documentType", "label=Alle Felder (Testdokumenttyp)");
        $this->click("rights");
        $this->click("send");
        $this->waitForPageToLoad("30000");
        $this->select("SubjectDDC1", "label=0 Informatik, Informationswissenschaft, allgemeine Werke");
        $this->click("EnrichmentLegalNotices");
        $this->click("browseDownSubjectDDC");
        $this->waitForPageToLoad("30000");
        $this->select("collId2SubjectDDC1", "label=05 Zeitschriften, fortlaufende Sammelwerke");
        $this->click("send");
        $this->waitForPageToLoad("30000");
        for ($second = 0;; $second++) {
            if ($second >= 60)
                $this->fail("timeout");
            try {
                if ($this->isTextPresent("05 Zeitschriften, fortlaufende Sammelwerke"))
                    break;
            } catch (Exception $e) {
                
            }
            sleep(1);
        }

        $this->assertTrue($this->isElementPresent("//div[@id='form-table-check']/fieldset"));
        $this->click("send");
        $this->waitForPageToLoad("30000");
        $this->assertTrue($this->isTextPresent("erfolgreich gespeichert"));
    }

}

?>