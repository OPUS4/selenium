# Selenium Tests for OPUS 4

This are the PHPUnit tests for testing the web user interface of OPUS 4.

## Requirements

* Running OPUS 4 Instanz
* Firefox
* Java
* Selenium Server Jar

The Selenium server can be downloaded from <http://www.seleniumhq.org>. The Selenium Standalone Server
is needed.

## Getting Started

In order to run the tests you need to get the files from GitHub.

    $ git clone https://github.com/OPUS4/selenium

You can download the necessary PHP libraries.

    $ bin/install-composer.php

## Starting Selenium Server

Using Xvfb a virtual sceen can be created and used with the Selenium server. Without it all tests
would be run in Firefox on the desktop, constantly grabbing the focus, thus making it impossible
to use the system while running the tests.

    $ Xvfb :10

    $ DISPLAY=:10 java -jar selenium-server.jar -log selenium.log

## Running Tests

Tests can be run using the proved Ant build file using the following command

    $ ant phpunit

or it can be run directly using the phpunit installed by Composer.

    $ cd tests
    $ ../vendor/bin/phpunit .
