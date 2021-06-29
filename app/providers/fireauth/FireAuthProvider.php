<?php

namespace App\Providers\FireAuth;

use App\Provider;

class FireAuthProvider extends Provider
{
    public function __construct()
    {
        parent::__construct("FireAuth", "fireauth.png", "/login/fireauth", null, null);
    }
}
