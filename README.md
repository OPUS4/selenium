# Selenium Tests for OPUS 4

This are the PHPUnit tests for testing the web user interface of OPUS 4.

## Requirements

* Running OPUS 4 Instanz
* Firefox
* Java

## Getting Started

In order to run the tests you need to get the files from GitHub.

    $ git clone https://github.com/OPUS4/selenium

You can download the necessary PHP libraries.

    $ bin/install-composer.php

## Starting Selenium Server

    $ Xvfb :10

    $ DISPLAY=:10 java -jar selenium-server.jar -log selenium.log

## Running Tests

    $ ant phpunit

oder

    $ cd tests
    $ ../vendor/bin/phpunit .
