<?php

use Provider as ProviderInterface;

class Provider implements ProviderInterface
{
    private $name;
    private $logo;

    private $route;

    private $url;
    private $redirectUrl;

    public function __construct($name, $logo, $route, $url, $redirectUrl)
    {
        $this->name = $name;
        $this->logo = $logo;
        $this->route = $route;
        $this->url = $url;
        $this->redirectUrl = $redirectUrl;
    }
}
