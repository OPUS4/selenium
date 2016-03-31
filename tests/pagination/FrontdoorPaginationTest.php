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
 * @package     Tests
 * @author      Edouard Simon <kontakt@ejsimon.de>
 * @copyright   Copyright (c) 2015, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'TestCase.php';

class FrontdoorPaginationTest extends TestCase {

    public function testSolrsearchHitLinkContainsSearchParameters() {

        $frontdoorLink = "/frontdoor/index/index/searchtype/all/docId/150/start/4/rows/10";

        $this->open("/solrsearch/index/search/searchtype/all");
        $this->waitForPageToLoad();
        $this->assertTrue(
                $this->frontdoorLinkExists(5, $frontdoorLink)
        );
        $this->openAndWait($frontdoorLink);
        $this->assertText('//span[@id="pagination-current-hit"]', '5');
        $this->assertText('//span[@id="pagination-num-hits"]', '142');
    }

    public function testBrowsingHitLinkContainsSearchParameters() {

        $frontdoorLink = "/frontdoor/index/index/searchtype/collection/id/63/docId/8/start/1/rows/10";

        $this->open("/solrsearch/index/search/searchtype/collection/id/63");
        $this->waitForPageToLoad();
        $this->assertTrue(
                $this->frontdoorLinkExists(2, $frontdoorLink)
        );
        $this->openAndWait($frontdoorLink);
        $this->assertText('//span[@id="pagination-current-hit"]', "2");
    }

    public function testFrontdoorDisplayDocumentWithSearchUrl() {
        $this->open("/frontdoor/index/index/searchtype/all/start/7/rows/10");
        $this->waitForPageToLoad();
        $this->assertTextPresent('urn:nbn:de:foo:123-bar-456');
    }

    public function testFrontdoorDisplayDocumentWithAdvancedSearchUrl() {
        $this->open("/frontdoor/index/index/start/1/rows/10/sortfield/score/sortorder/desc/searchtype/advanced/author/Doe/authormodifier/contains_all/title/test/titlemodifier/contains_all/fulltext/Unwort/fulltextmodifier/contains_none/year/2008/yearmodifier/contains_all");
        $this->waitForPageToLoad();
        $this->assertTextPresent('This is a html test document');
    }

    public function testFrontdoorBacklinkRespectsCurrentPagePosition() {

        $currentPageUrl = "/solrsearch/index/search/searchtype/all/start/10/rows/10";
        $previousPageUrl = "/solrsearch/index/search/searchtype/all/start/0/rows/10";
        $this->open($currentPageUrl);
        $this->waitForPageToLoad();
        $this->frontdoorLinkClick(1);
        $this->assertText('//span[@id="pagination-current-hit"]', '11');
        $this->isElementPresent('a[@id="pagination-link-hitlist" and @href="' . $currentPageUrl . '"]');
        $this->clickAndWait('//li[@id="pagination-previous"]/a');
        $this->assertText('//span[@id="pagination-current-hit"]', '10');
        $this->isElementPresent('a[@id="pagination-link-hitlist" and @href="' . $previousPageUrl . '"]');
    }

    public function testFirstEntryInListContainsNavigation() {

        $frontdoorLink = "/frontdoor/index/index/searchtype/all/start/0/rows/10/docId/305";
        $this->openAndWait($frontdoorLink);
        $this->assertText('//span[@id="pagination-current-hit"]', '1');
        $this->assertText('//span[@id="pagination-num-hits"]', '142');
    }

    public function testClickPreviousOnSecondEntryShowsFirstEntry() {

        $frontdoorLink = "/frontdoor/index/index/searchtype/all/start/1/rows/10/docId/305";
        $this->openAndWait($frontdoorLink);
        $this->clickAndWait('//li[@id="pagination-previous"]/a');
        $this->assertText('//span[@id="pagination-current-hit"]', '1');
        $this->assertText('//span[@id="pagination-num-hits"]', '142');
    }

    public function testLatestSearch() {
        $this->switchToGerman();
        $frontdoorLink = "/frontdoor/index/index/searchtype/latest/docId/150/start/4/rows/10";
        $this->openAndWait($frontdoorLink);
        $this->assertTextNotPresent("Das Suchergebnis hat sich seit Ihrer Suchanfrage verändert. Eventuell werden Dokumente in anderer Reihenfolge angezeigt.");
        $this->assertText('//span[@id="pagination-current-hit"]', '5');
        $this->assertText('//span[@id="pagination-num-hits"]', '10');
    }
    
    public function testClickNextUrlContainsParameterNavWithValueNext() {

        $frontdoorLink = "/frontdoor/index/index/searchtype/all/start/1/rows/10/docId/305";
        $this->openAndWait($frontdoorLink);
        $this->clickAndWait('//li[@id="pagination-next"]/a');
        $url = $this->getLocation();
        $this->assertTrue(strpos($url, 'nav/next') !== false, "Parameter 'nav' with value 'next' not present");

    }

    public function testClickPreviousUrlContainsParameterNavWithValuePrev() {

        $frontdoorLink = "/frontdoor/index/index/searchtype/all/start/1/rows/10/docId/305";
        $this->openAndWait($frontdoorLink);
        $this->clickAndWait('//li[@id="pagination-previous"]/a');
        $url = $this->getLocation();
        $this->assertTrue(strpos($url, 'nav/prev') !== false, "Parameter 'nav' with value 'prev' not present");

    }

    public function testClickNextUrlContainsDocId() {

        $frontdoorLink = "/frontdoor/index/index/searchtype/all/start/1/rows/10/docId/305";
        $this->openAndWait($frontdoorLink);
        $this->clickAndWait('//li[@id="pagination-next"]/a');
        $url = $this->getLocation();
        $this->assertTrue(strpos($url, 'docId') !== false, "Parameter 'docId' not present");
    }

    protected function frontdoorLinkExists($number, $href) {
        return $this->isElementPresent('//dl[contains(concat(" ", normalize-space(@class), " "), " result_box ")][' . $number . ']/dt[contains(concat(" ", normalize-space(@class), " "), " results_title ")]/a[contains(@href,"' . $href . '")]');
    }

    protected function frontdoorLinkClick($number) {
        $this->clickAndWait('//dl[contains(concat(" ", normalize-space(@class), " "), " result_box ")][' . $number . ']/dt[contains(concat(" ", normalize-space(@class), " "), " results_title ")]/a');
    }

}

?>
