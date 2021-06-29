<?php

namespace App\Providers\Google;

use App\Provider;

class GoogleProvider extends Provider
{
    public function __construct()
    {
        parent::__construct("Google", "google.png", "/login/google", null, null);
    }
}
