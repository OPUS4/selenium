<?PHP
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
 * @copyright   Copyright (c) 2008-2013, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCase.php';

class Regression2972Test extends TestCase {

    /**
     * Regression test for OPUSVIER-2972.
     */
    public function testSavingValueThatExceedsMaxValueLengthInDB() {
        $this->switchToEnglish();
        $this->login();

        $this->openAndWait('/admin/document/edit/id/146');
        $this->type('Document-General-PublishedDate', 'blabla');

        // Zur Seite zum Hinzufügen einer Person wechseln. Das speichert den Zustand des Formulars in der Session.
        $this->clickAndWait('Document-Persons-author-Add');

        // Das Editieren einfach verlassen ohne Cancel oder Save zu klicken. Der Zustand bleibt gespeichert.
        $this->openAndWait('/admin/documents');

        // Das Dokument erneut zum Editieren aufrufen.
        $this->openAndWait('/admin/document/edit/id/146');

        // Durch den Bug wurde der alte Zustand wiederhergestellt.
        $this->assertElementValueNotEquals('Document-General-PublishedDate', 'blabla');
        $this->assertElementValueEquals('Document-General-PublishedDate', '2007/04/30');
    }

}