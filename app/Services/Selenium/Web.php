<?php namespace App\Services\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class Web{
    private $driver;

    public function __construct(){
        $this->driver = RemoteWebDriver::create('http://localhost:9515', DesiredCapabilities::chrome());
    }

    public function nav($url){
        if(!$url) throw new UserException('Необходимо указать url');
        $this->driver->get($url);
    }

    public function find($selector){
        if(!$selector) throw new UserException('Необходимо указать css - селектор');
        return $this->driver->findElements(WebDriverBy::cssSelector($selector));
    }

    public function findOne($selector){
        if(!$selector) throw new UserException('Необходимо указать css - селектор');
        return $this->driver->findElement(WebDriverBy::cssSelector($selector));
    }

    public function quit(){
        $this->driver->quit();
    }
}