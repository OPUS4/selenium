<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class InvalidTest extends PHPUnit_Extensions_SeleniumTestCase
{
  protected $captureScreenshotOnFailure = TRUE;
  protected $screenshotPath = '/home/opus4ci/cruisecontrol/webapps/screenshots';
  protected $screenshotUrl = 'http://opus4ci.zib.de:8080/screenshots';
 
  protected function setUp()
  {
    $this->setBrowser("*firefox");
    $this->setBrowserUrl("http://opus4web.zib.de");
  }

  public function testOpus5()
  {
    $this->markTestSkipped('only used for demonstration purpose');
    $this->open("/opus4-matheon/home");
    $this->assertTrue($this->isTextPresent("Opus 5"));
  }
}
?>
