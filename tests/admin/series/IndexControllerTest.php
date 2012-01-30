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
 * @copyright   Copyright (c) 2008-2011, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class Admin_Series_IndexControllerTest extends TestCase {

    /*
    public function setUp() {
	parent::setUp();
	$this->login();
    }

    public function tearDown() {
	$this->logout();
	parent::tearDown();
    }
    */

    public function testShowSeries() {
	$this->login();
        $this->open('/opus4-selenium/admin/series/show/id/1');
        $this->waitForPageToLoad();

        $this->assertElementPresent("//div[@class='Id']");
        $this->assertElementPresent("//div[@class='Title']");
        $this->assertElementPresent("//div[@class='Visible']");
        $this->assertElementPresent("//div[@class='Infobox']");

	$this->logout();
    }

    public function testHideDocumentsLinkForSeriesWithoutDocuments() {
	$this->login();
        $this->open('/opus4-selenium/admin/series');
        $this->waitForPageToLoad();

        $this->assertElementPresent("//a[@href='/opus4-selenium/admin/documents/index/seriesid/1']");
        $this->assertElementPresent("//a[@href='/opus4-selenium/admin/documents/index/seriesid/2']");
        $this->assertElementPresent("//a[@href='/opus4-selenium/admin/documents/index/seriesid/3']");
        $this->assertElementPresent("//a[@href='/opus4-selenium/admin/documents/index/seriesid/4']");
        $this->assertElementPresent("//a[@href='/opus4-selenium/admin/documents/index/seriesid/5']");
        $this->assertElementPresent("//a[@href='/opus4-selenium/admin/documents/index/seriesid/6']");
        $this->assertElementNotPresent("//a[@href='/opus4-selenium/admin/documents/index/seriesid/7']");
        $this->assertElementNotPresent("//a[@href='/opus4-selenium/admin/documents/index/seriesid/8']");

	$this->logout();
    }

    public function testSeriesVisibilityIsDisplayedCorrectly() {
        $this->login();
        $this->open('/opus4-selenium/admin/series');
        $this->waitForPageToLoad();
	foreach (array(1, 2, 4, 5, 6, 8) as $visibleId) {
	   $this->assertElementPresent('//td[@class="visible"]/a[@href="/opus4-selenium/admin/series/show/id/' . $visibleId . '"]');
	}
	foreach (array(3, 7) as $unvisibleId) {
           $this->assertElementPresent('//td[@class="unvisible"]/a[@href="/opus4-selenium/admin/series/show/id/' . $unvisibleId . '"]');
	}

        $this->logout();
    }

}
