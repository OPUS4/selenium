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

class SeriesCollectionVisibilityTest extends TestCase {

    public function testSeriesCollectionVisibility() {
        $this->markTestSkipped('has to be redesigned for new series concept');

        $this->switchToGerman();
        $this->open("/publish");
        $this->click("//li[@id='primary-nav-publish']/a/em/span");
        $this->waitForPageToLoad();

        $this->login();

        $this->assertTrue($this->isElementPresent("link=English"));
        
        $this->click("link=Administration");
        $this->waitForPageToLoad();
        $this->click("link=Sammlungen verwalten");
        $this->waitForPageToLoad();
        $this->click("link=Schriftenreihen");
        $this->waitForPageToLoad();
        $this->click("link=Hamburger Berichte zur Siedlungswasserwirtschaft");
        $this->waitForPageToLoad();
        $this->click("link=Einblenden");
        $this->waitForPageToLoad();
        
        $this->click("//li[@id='primary-nav-publish']/a/span");
        $this->waitForPageToLoad();
        $this->select("documentType", "label=Alle Felder (Testdokumenttyp)");
        $this->click("rights");
        $this->click("send");
        $this->waitForPageToLoad();
        $this->select("Series1", "label=Hamburger Berichte zur Siedlungswasserwirtschaft");
        $this->click("browseDownSeries");
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent("browseUpSeries"));
        $this->assertFalse($this->isElementPresent("browseDownSeries"));
        
        $this->click("//li[@id='primary-nav-administration']/a/span");
        $this->waitForPageToLoad();
        $this->click("link=Sammlungen verwalten");
        $this->waitForPageToLoad();
        $this->click("link=Schriftenreihen");
        $this->waitForPageToLoad();
        $this->click("link=Hamburger Berichte zur Siedlungswasserwirtschaft");
        $this->waitForPageToLoad();
        $this->click("link=Ausblenden");
        $this->waitForPageToLoad();
        $this->click("//li[@id='primary-nav-publish']/a/span");
        $this->waitForPageToLoad();
        $this->select("documentType", "label=Alle Felder (Testdokumenttyp)");
        $this->click("rights");
        $this->click("send");
        $this->waitForPageToLoad();
        $this->assertFalse($this->isElementPresent("browseUpSeries"));

        $this->logout();
        $this->waitForPageToLoad();
    }

}

?>
