<?php

use Provider;

class FacebookProvider extends Provider
{
    public function __construct($name, $logo, $route, $url, $redirectUrl)
    {
        parent::__construct($name, $logo, $route, $url, $redirectUrl);
    }
}
