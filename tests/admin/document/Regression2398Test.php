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
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $$
 */

require_once 'TestCase.php';

class Regression2398Test extends TestCase {

    /**
     * Regression test for OPUSVIER-2398
     */
    public function testSuccessMessageIsTranslatedAfterCollectionRoleDocumentAssignment() {
        $this->login();

        $this->open("/opus4-selenium/home/index/language/language/de");
        $this->waitForPageToLoad();

        $this->open('/opus4-selenium/admin/collection/assign/document/92');
        $this->waitForPageToLoad();

        // Zuweisung zur DDC-Root-Collection
        $this->click("//form[@action='/opus4-selenium/admin/collection/assign/id/2/document/92']/input");
        $this->waitForPageToLoad();

        $this->assertTextPresent("Die Verknüpfung des Dokuments zur Sammlung 'ddc' wurde erfolgreich erstellt.");

        // Zuweisung wieder entfernen
        $this->open("/opus4-selenium/admin/document/edit/id/92/section/collections");
        $this->waitForPageToLoad();

        $this->open("/opus4-selenium/admin/document/unlinkcollection/id/92/section/collections/role/2/collection/2");
        $this->waitForPageToLoad();

        $this->assertTextPresent("Die Verknüpfung des Dokuments zur Sammlung 'ddc' wurde erfolgreich entfernt.");
    }

    /**
     * Regression test for OPUSVIER-2398
     */
    public function testSuccessMessageIsTranslatedAfterCollectionDocumentAssignment() {
        $this->login();

        $this->open("/opus4-selenium/home/index/language/language/de");
        $this->waitForPageToLoad();

        $this->open('/opus4-selenium/admin/collection/assign/id/2/document/92');
        $this->waitForPageToLoad();

        // Zuweisung zur DDC-Collection 1
        $this->click("//form[@action='/opus4-selenium/admin/collection/assign/id/4/document/92']/input");
        $this->waitForPageToLoad();

        $this->assertTextPresent("Die Verknüpfung des Dokuments zur Sammlung '1 Philosophie und Psychologie' wurde erfolgreich erstellt.");

        // Zuweisung wieder entfernen
        $this->open("/opus4-selenium/admin/document/edit/id/92/section/collections");
        $this->waitForPageToLoad();

        $this->open("/opus4-selenium/admin/document/unlinkcollection/id/92/section/collections/role/2/collection/4");
        $this->waitForPageToLoad();

        $this->assertTextPresent("Die Verknüpfung des Dokuments zur Sammlung '1 Philosophie und Psychologie' wurde erfolgreich entfernt.");
    }
}
