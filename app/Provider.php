<?php

interface ProviderInterface
{
}

class Provider implements ProviderInterface
{
    private $name;
    private $logo;

    private $route;

    private $url;
    private $redirectUrl;

    public function __construct($name, $logo, $url, $redirectUrl)
    {
        $this->name = $name;
        $this->logo = $logo;
        $this->url = $url;
        $this->redirectUrl = $redirectUrl;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function getRoute()
    {
        return $this->route;
    }
}
