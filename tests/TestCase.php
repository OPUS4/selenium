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
 * @category    TODO
 * @package     TODO
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2012, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class TestCase extends PHPUnit_Extensions_SeleniumTestCase {

    protected $baseUrl = '/opus4-selenium';

    protected $captureScreenshotOnFailure = TRUE;
    protected $screenshotPath = '/home/opus4ci/cruisecontrol/webapps/screenshots';
    protected $screenshotUrl = 'http://opus4ci.zib.de:8080/screenshots';
    protected $defaultMaxPeriodToWait = '30000';

    public function setUp() {
        $this->setBrowser("*firefox");
        $this->setBrowserUrl("http://opus4web.zib.de");
    }

    public function login($user = 'admin', $password = 'adminadmin') {
        // make sure logged out
        $this->logout();

        // login
        $this->open('/opus4-selenium/auth/login');
        $this->waitForPageToLoad();
        $this->type('login', $user);
        $this->type('password', $password);
        $this->click('SubmitCredentials');
        $this->waitForPageToLoad();
    }

    public function logout() {
        $this->open('/opus4-selenium/auth/logout');
        $this->waitForPageToLoad();
    }

    public function waitForPageToLoad($period = null) {
        if (is_null($period)) {
            $period = $this->defaultMaxPeriodToWait;
        }
        parent::waitForPageToLoad($period);
    }

    /**
     * Changes language to English.
     */
    public function switchToEnglish() {
        $this->open('/opus4-selenium/home/index/language/language/en');
        $this->waitForPageToLoad();
    }

    /**
     * Changes language to German.
     */
    public function switchToGerman() {
        $this->open('/opus4-selenium/home/index/language/language/de');
        $this->waitForPageToLoad();
    }

    public function openAndWait($path) {
        $this->open($this->baseUrl . $path);
        $this->waitForPageToLoad();
    }

}
