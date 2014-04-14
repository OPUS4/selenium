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
 * @category  Application Selenium Test
 * @package
 * @author    Sascha Szott <szott@zib.de>
 * @author    Jens Schwidder <schwidder@zib.de>
 * @copyright Copyright (c) 2008-2012, OPUS 4 development team
 * @license   http://www.gnu.org/licenses/gpl.html General Public License
 * @version   $Id$
 */
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class TestCase extends PHPUnit_Extensions_SeleniumTestCase {
    
    public $name = "test";

    protected $browser = '*firefox';
    protected $browserUrl = 'http://opus4web.zib.de';
    protected $baseUrl = '/opus4-selenium';
    
    protected $clientIp = '130.73.63.60';

    protected $captureScreenshotOnFailure = true;
    protected $screenshotPath = '.';
    protected $screenshotUrl = '';
    protected $defaultMaxPeriodToWait = '30000';

    protected $adminUsername = "admin";
    protected $adminPassword = "adminadmin";

    public function setUp() {
        if(is_file('config.ini') && is_readable('config.ini')) {
            $config = parse_ini_file('config.ini');
            $configOptions = array (
                'browserUrl',
                'baseUrl',
                'clientIp',
                'captureScreenshotOnFailure',
                'screenshotPath',
                'screenshotUrl',
                'defaultMaxPeriodToWait',
                'adminUsername',
                'adminPassword'
            );
            foreach ($configOptions as $configOption) {
                $this->setConfigOption($config, $configOption);
            }
        }
        $this->setBrowser($this->browser);
        $this->setBrowserUrl($this->browserUrl);
    }

    private function setConfigOption($config, $key) {
        if (array_key_exists($key, $config)) {
            $this->$key = $config[$key];
        }
    }

    public function login($user = null, $password = null) {
        // make sure logged out
        $this->logout();

        // login
        $this->openAndWait('/auth/login');
        if (is_null($user)) {
            $user = $this->adminUsername;
        }
        $this->type('login', $user);
        if (is_null($password)) {
            $password = $this->adminPassword;
        }
        $this->type('password', $password);
        $this->clickAndWait('SubmitCredentials');
    }

    public function logout() {
        $this->open('/auth/logout');
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
        $this->open('/home/index/language/language/en');
        $this->waitForPageToLoad();
    }

    /**
     * Changes language to German.
     */
    public function switchToGerman() {
        $this->open('/home/index/language/language/de');
        $this->waitForPageToLoad();
    }

    public function open($path) {
        parent::open($this->baseUrl . $path, 'true');
    }

    public function openAndWait($path) {
        $this->open($path);
        $this->waitForPageToLoad();
    }
    
    public function clickAndWait($path) {
        $this->click($path);
        $this->waitForPageToLoad();
    }

    public function openWindow($path, $windowName) {
        parent::openWindow($this->baseUrl . $path, $windowName);
    }

    public function selectWindow($windowName) {
        parent::selectWindow($windowName);
    }

    public function enableScreenshots() {
        $this->captureScreenshotOnFailure = true;
    }

    public function disableScreenshots() {
        $this->captureScreenshotOnFailure = false;
    }

    /**
     * Prüft, ob die Testinstanz mit APPLICATION_ENV = 'testing' läuft.
     * @return bool
     */
    public function isApplicationEnvTesting() {
        return $this->isMode('testing');
    }

    /**
     * Prüft, ob die Testinstanz mit APPLICATION_ENV = 'production' läuft.
     * @return bool
     */
    public function isApplicationEnvProduction() {
        return $this->isMode('production');
    }

    private function isMode($mode) {
        $this->open('/home');
        $this->waitForPageToLoad();
        return $this->isElementPresent('//div[@id="appmode-' . $mode . '"]');
    }

}
