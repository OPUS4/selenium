<?php

require_once 'TestCase.php';

class InvalidTest extends TestCase
{
  public function testOpus5()
  {
    $this->markTestSkipped('only used for demonstration purpose');
    $this->open("/opus4-matheon/home");
    $this->assertTrue($this->isTextPresent("Opus 5"));
  }
}
?>
