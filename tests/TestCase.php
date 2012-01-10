<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class TestCase extends PHPUnit_Extensions_SeleniumTestCase
{
  protected $captureScreenshotOnFailure = TRUE;
  protected $screenshotPath = '/home/opus4ci/cruisecontrol/webapps/screenshots';
  protected $screenshotUrl = 'http://opus4ci.zib.de:8080/screenshots';

  protected function setUp() {
    $this->setBrowser("*firefox");
    $this->setBrowserUrl("http://opus4web.zib.de");
  }

    protected function login($user = 'admin', $password = 'adminadmin') {
        // make sure logged out
	$this->logout();

        // login
        $this->open('/opus4-selenium/auth/login');
        $this->waitForPageToLoad('30000');
        $this->type('login', 'admin');
        $this->type('password', 'adminadmin');
        $this->click('SubmitCredentials');
        $this->waitForPageToLoad('30000');
    }

    public function logout() {
	$this->open('/opus4-selenium/auth/logout');
    }

}

?>
