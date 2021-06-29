<?php

namespace App\Providers\Facebook;

use App\Provider;

class FacebookProvider extends Provider
{
    public function __construct()
    {
        parent::__construct("Facebook", "facebook.png", "/login/facebook", null, null);
    }
}
